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
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $item['name'],
                    ],
                    'unit_amount' => $item['unit_price'] * 100, // in cents
                ],
                'quantity' => $item['quantity'],
            ];
        })->toArray();

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => url('/success'),
            'cancel_url' => url('/cancel'),
        ]);

        return response()->json(['id' => $session->id]);
    }

}
