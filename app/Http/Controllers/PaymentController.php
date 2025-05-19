<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Checkout\Session;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

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

            // Primary source: Checkout Session's customer_details
            $billingDetails = $session->customer_details ?? null;

            // Fallback: Charge-level details (if needed)
            $chargeDetails = $session->amount_total ?? null;


            
            
            // Save order to database
        $order = new Order();
        $order->status = 'unpaid';
        $order->total_price = $chargeDetails;
        $order->session_id  = $session->id;
        $order->user_id  = $session->id;
        $order->address  = $session->id;
    
        // $order->save();
            return response()->json([
                'paid'        => $session->payment_status === 'paid',
                'customer'    => $billingDetails,
                'charge_data' => $chargeDetails,
            ]);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Always log Stripe errors
            // \Log::error('Stripe API Error: '.$e->getMessage());
            return response()->json(['error' => 'Payment verification failed'], 400);
        }
    }
}
