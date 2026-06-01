<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function createSession(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.name' => 'required|string',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $lineItems = [];
        $total = 0;
        $rawItems = [];

        foreach ($request->items as $item) {
            $rawItems[] = [
                'name' => $item['name'],
                'unit_price' => $item['unit_price'],
                'quantity' => $item['quantity'],
            ];

            $lineItems[] = [
                'price_data' => [
                    'currency' => 'cad',
                    'product_data' => ['name' => $item['name']],
                    'unit_amount' => $item['unit_price'] * 100,
                ],
                'quantity' => $item['quantity'],
            ];

            $total += $item['unit_price'] * $item['quantity'];
        }

        $tax = round($total * 0.13, 2);

        $lineItems[] = [
            'price_data' => [
                'currency' => 'cad',
                'product_data' => ['name' => 'Tax (13%)'],
                'unit_amount' => (int) round($tax * 100),
            ],
            'quantity' => 1,
        ];

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success', [], true) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('api.checkout.cancel', [], true),
            'billing_address_collection' => 'required',
        ]);

        Order::create([
            'status' => 'unpaid',
            'menu' => $rawItems,
            'total_price' => $total + $tax,
            'session_id' => $session->id,
            'user_id' => Auth::id(),
            'address' => null,
        ]);

        return response()->json(['id' => $session->id]);
    }

    public function success(Request $request)
    {
        try {
            Stripe::setApiKey(config('services.stripe.secret'));

            $session = Session::retrieve([
                'id' => $request->get('session_id'),
                'expand' => [
                    'customer',
                    'payment_intent',
                    'payment_intent.charges.data.billing_details',
                ],
            ]);

            $order = Order::where('session_id', $session->id)->firstOrFail();

            $order->update([
                'status' => $session->payment_status,
                'address' => $session->customer_details->address ?? null,
            ]);

            $email = $session->customer_details->email;
            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $session->customer_details->name ?? 'Customer',
                    'password' => bcrypt(Str::random(40)),
                ]
            );

            if ($user->wasRecentlyCreated) {
                $token = Password::createToken($user);
                $user->sendWelcomeNotification($token);
            }

            $order->update(['user_id' => $user->id]);

            return response()->json([
                'order' => $order,
                'requires_password_setup' => $user->wasRecentlyCreated,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function cancel()
    {
        return response()->json(['message' => 'Payment cancelled']);
    }
}
