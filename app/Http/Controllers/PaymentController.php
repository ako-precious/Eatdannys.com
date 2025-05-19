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
use Illuminate\Support\Str;

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
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $session = \Stripe\Checkout\Session::retrieve([
                'id' => $request->get('session_id'),
                'expand' => [
                    'customer',
                    'payment_intent',
                    'payment_intent.charges.data.billing_details'
                ],
            ]);

            // Retrieve the associated order
            $order = Order::where('session_id', $session->id)->first();

            if (!$order) {
                return response()->json(['error' => 'Order not found'], 404);
            }

            $billingDetails = $session->customer_details;
            $email = $billingDetails->email ?? null;

            // Update order with payment status and address
            $order->update([
                'status' => $session->payment_status,
                'address' => $billingDetails ? json_encode($billingDetails->address) : null
            ]);

            $user = null;
            $requiresSignup = false;

            if ($email) {
                // Find or create user
                $user = User::firstOrCreate(
                    ['email' => $email],
                    [
                        'name' => $billingDetails->name ?? 'Customer',
                        'password' => bcrypt(Str::random(16)), // Temporary password
                    ]
                );

                // Check if the user was just created
                if ($user->wasRecentlyCreated) {
                    $requiresSignup = true;
                    // Consider sending a password reset email here
                }

                // Associate order with user
                $order->update(['user_id' => $user->id]);
            }

            return response()->json([
                'paid' => $session->payment_status === 'paid',
                'customer' => $billingDetails,
                'requires_signup' => $requiresSignup,
                'user_exists' => !$requiresSignup && $user !== null,
                'order_updated' => true
            ]);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // \Log::error('Stripe Error: ' . $e->getMessage());
            return response()->json(['error' => 'Payment verification failed'], 400);
        } catch (\Exception $e) {
            // \Log::error('System Error: ' . $e->getMessage());
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }
}
