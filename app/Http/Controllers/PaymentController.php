<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Checkout\Session;
use App\Models\Order;

class PaymentController extends Controller
{
    //

    public function createSession(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    
        // Validate all items first
        foreach ($request->items as $item) {
            if (!isset($item['name'], $item['unit_price'], $item['quantity'])) {
                return response()->json(['error' => 'Invalid cart data'], 400);
            }
        }
    
        // Build Stripe line items and calculate total price
        $lineItems = [];
        $total = 0;
    
        foreach ($request->items as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'cad',
                    'product_data' => [
                        'name' => $item['name'],
                    ],
                    'unit_amount' => $item['unit_price'] * 100, // in cents
                ],
                'quantity' => $item['quantity'],
            ];
    
            $total += $item['unit_price'] * $item['quantity'];
        }
    
        // Create the Stripe checkout session
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success', ['session_id' => '{CHECKOUT_SESSION_ID}']),
            'cancel_url' => route('checkout.cancel'),
        ]);
    
        // Save order to database
        // $order = new Order();
        // $order->status = 'unpaid';
        // $order->total_price = $total;
        // $order->session_id  = $session->id;
        // $order->save();
    
        return response()->json(['id' => $session->id]);
    }
    
    public function success(Request $request)
{
    Stripe::setApiKey(config('stripe.secret'));

    $sessionId = $request->get('session_id');

    if (!$sessionId) {
        abort(400, 'Session ID is required');
    }

    $session = Session::retrieve($sessionId);

    return Inertia::render('Payment/Success', [
        'session' => $session
    ]);
}
    // public function success(Request $request)
    // {
    //     Stripe::setApiKey(env('STRIPE_SECRET'));
        
    //     $sessionId = $request->get('session_id');

    //     if (!$sessionId) {
    //         abort(400, 'Session ID is required');
    //     }

    //     \Stripe\Stripe::setApiKey(config('stripe.secret'));

    //     $session = \Stripe\Checkout\Session::retrieve($sessionId);

    //     // Fetch order using $session->metadata or session details
    //     return inertia('Payment/Success', [
    //         'session' => $session
    //     ]);
    // }
}
