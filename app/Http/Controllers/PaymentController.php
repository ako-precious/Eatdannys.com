<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Checkout\Session;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\Jetstream; // Add this import
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str; // Add this for password generation

class PaymentController extends Controller
{
    //

    public function createSession(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        // Validate request structure
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.name' => 'required|string',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // Build Stripe line items and calculate total
        $lineItems = [];
        $total = 0;
        $rawItems = []; // To store original items

        foreach ($request->items as $item) {
            // Store original item data
            $rawItems[] = [
                'name' => $item['name'],
                'unit_price' => $item['unit_price'],
                'quantity' => $item['quantity']
            ];

            // Stripe format
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

        // Create Stripe session
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('checkout.cancel', [], true),
            'billing_address_collection' => 'required'
        ]);

        // Create order record
        $order = new Order();
        $order->status = 'unpaid';
        $order->menu = $rawItems;  // Store original items data
        $order->total_price = $total;
        $order->session_id = $session->id;
        $order->user_id = Auth::check() ? Auth::id() : null;
        $order->address = null;
        $order->save();

        return response()->json(['id' => $session->id]);
    }

    // $session = \Stripe\Checkout\Session::retrieve([
    //     'id' => $request->get('session_id'),
    //     'expand' => [
    //         'customer',
    //         'payment_intent',
    //         'payment_intent.charges.data.billing_details'
    //     ],
    // ]);

public function success(Request $request)
{
    try {
        // Retrieve Stripe session
        // $session = \Stripe\Checkout\Session::retrieve($request->session_id);
  Stripe::setApiKey(config('services.stripe.secret'));
        $session = \Stripe\Checkout\Session::retrieve([
        'id' => $request->get('session_id'),
        'expand' => [
            'customer',
            'payment_intent',
            'payment_intent.charges.data.billing_details'
        ],
    ]);
        // Find the order
        $order = Order::where('session_id', $session->id)->firstOrFail();

        // Update order status and address
        $order->update([
            'status' => $session->payment_status,
            'address' => json_encode($session->customer_details->address ?? null)
        ]);

        // Handle user creation/association
        $email = $session->customer_details->email;
        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $session->customer_details->name ?? 'Customer',
                'password' => bcrypt(Str::random(40)) // Temporary unusable password
            ]
        );

        // If new user, send Jetstream-style verification
       if ($user->wasRecentlyCreated) {
            $token = Password::createToken($user); // Simplified token generation
            $user->sendWelcomeNotification($token);
        }


        // Associate order with user
        $order->update(['user_id' => $user->id]);

        return response()->json([
            'order' => $order,
            'requires_password_setup' => $user->wasRecentlyCreated = true ,
        ]);

    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
}
