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
        // Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe::setApiKey(config('services.stripe.secret'));

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
            'success_url' => route('checkout.success', [], true)."?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('checkout.cancel', [], true),
            'billing_address_collection' => 'required'
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
    \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

    $session = \Stripe\Checkout\Session::retrieve([
        'id' => $request->get('session_id'),
        'expand' => ['payment_intent'],
    ]);

    $paymentIntent = $session->payment_intent;

    // Now expand the charges of the PaymentIntent
    $paymentIntent = \Stripe\PaymentIntent::retrieve([
        'id' => $paymentIntent->id,
        'expand' => ['charges'],
    ]);

    // Get the first charge if it exists
    $charge = $paymentIntent->charges->data[0] ?? null;

    return response()->json([
        'status' => $paymentIntent->status,
        'paid' => $paymentIntent->status === 'succeeded',
        'billing_details' => $charge ? $charge->billing_details : null,
    ]);
}

    
//     public function success(Request $request)
// {
//     // Stripe::setApiKey(config('stripe.secret'));
//     Stripe::setApiKey(config('services.stripe.secret'));


//     $sessionId = $request->get('session_id');

//     if (!$sessionId) {
//         abort(400, 'Session ID is required');
//     }

//     // $session = Session::retrieve($sessionId);

//     $session = \Stripe\Checkout\Session::retrieve($sessionId);

//     $paymentIntent = \Stripe\PaymentIntent::retrieve([
//         'id' => $session->payment_intent,
//         'expand' => ['charges.data.billing_details'],
//     ]);

//     return response()->json([
//         'status' => $paymentIntent->status,
//         'paid' => $paymentIntent->status === 'succeeded',
//         'billing_details' => $paymentIntent->charges->data[0]->billing_details ?? null,
//     ]);
// }

// public function createSession(Request $request)
// {
//     Stripe::setApiKey(config('services.stripe.secret'));

//     // Validate items
//     foreach ($request->items as $item) {
//         if (!isset($item['name'], $item['unit_price'], $item['quantity'])) {
//             return response()->json(['error' => 'Invalid cart data'], 400);
//         }
//     }

//     // Prepare line items
//     $lineItems = [];
//     foreach ($request->items as $item) {
//         $lineItems[] = [
//             'price_data' => [
//                 'currency' => 'cad',
//                 'product_data' => [
//                     'name' => $item['name'],
//                 ],
//                 'unit_amount' => $item['unit_price'] * 100, // cents
//             ],
//             'quantity' => $item['quantity'],
//         ];
//     }

//     // ✅ Add customer_email if available
//     $email = auth()->check() ? auth()->user()->email : 'test@example.com'; // fallback for testing

//     $session = Session::create([
//         'payment_method_types' => ['card'],
//         'line_items' => $lineItems,
//         'mode' => 'payment',
//         'customer_email' => $email,
//         'success_url' => route('checkout.success', ['session_id' => '{CHECKOUT_SESSION_ID}']),
//         'cancel_url' => route('checkout.cancel'),
//     ]);

//     return response()->json(['id' => $session->id]);
// }

}
