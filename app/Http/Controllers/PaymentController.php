<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Checkout\Session;

class PaymentController extends Controller
{
    //

    public function createSession(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $lineItems = collect($request->items)->map(function ($item) {
            return [
                'price_data' => [
                    'currency' => 'cad',
                    'product_data' => [
                        'name' => $item['name'],
                    ],
                    'unit_amount' => $item['unit_price'] * 100, // in cents
                ],
                'quantity' => $item['quantity'],
            ];
        })->toArray();

        foreach ($request->items as $item) {
            if (!isset($item['name'], $item['unit_price'], $item['quantity'])) {
                return response()->json(['error' => 'Invalid cart data'], 400);
            }
        }
        
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
           'success_url' => route('checkout.success', ['session_id' => '{CHECKOUT_SESSION_ID}']),
    'cancel_url' => route('checkout.cancel'),
        ]);

        return response()->json(['id' => $session->id]);
    }

    public function success(Request $request)
{
    $sessionId = $request->get('session_id');

    if (!$sessionId) {
        abort(400, 'Session ID is required');
    }

    \Stripe\Stripe::setApiKey(config('stripe.secret'));

    $session = \Stripe\Checkout\Session::retrieve($sessionId);

    // Fetch order using $session->metadata or session details
    return view('checkout.success', [
        'session' => $session
    ]);
}

}
