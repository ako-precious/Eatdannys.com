<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    //// app/Http/Controllers/WebhookController.php
    public function handleWebhook(Request $request)
    {
        $payload = $request->getContent();
        $signature = $request->header('Stripe-Signature');
        $webhookSecret = config('services.stripe.webhook_secret'); // Retrieve from .env

        try {
            $event = Webhook::constructEvent(
                $payload,
                $signature,
                $webhookSecret
            );
        } catch (SignatureVerificationException $e) {
            // Invalid signature
            Log::error('Stripe webhook signature verification failed.', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Invalid signature'], 400);
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            Log::error('Stripe webhook received unexpected payload.', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Invalid payload'], 400);
        }

        // ... handle the event
        switch ($event->type) {
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object; // contains a Stripe\PaymentIntent
                $this->handlePaymentIntentSucceeded($paymentIntent);
                break;
            case 'payment_intent.payment_failed':
                $paymentIntent = $event->data->object; // contains a Stripe\PaymentIntent
                $this->handlePaymentIntentFailed($paymentIntent);
                break;
            case 'checkout.session.completed':
                $session = $event->data->object; // contains a Stripe\Checkout\Session
                $this->handleCheckoutSessionCompleted($session);
                break;
            // ... handle other event types you need
            default:
                Log::info("Received unhandled Stripe webhook event type: {$event->type}");
        }

        return response()->json(['status' => 'success'], 200);
    }
    protected function handlePaymentIntentSucceeded($paymentIntent)
{
    // Log or process the successful payment intent
    Log::info('PaymentIntent succeeded:', ['id' => $paymentIntent->id, 'amount' => $paymentIntent->amount]);

    // Example: Find the corresponding order in your database and mark it as paid
    // $order = App\Models\Order::where('payment_intent_id', $paymentIntent->id)->first();
    // if ($order) {
    //     $order->update(['status' => 'paid']);
    // }
}

protected function handlePaymentIntentFailed($paymentIntent)
{
    // Log or process the failed payment intent
    Log::error('PaymentIntent failed:', ['id' => $paymentIntent->id, 'last_payment_error' => $paymentIntent->last_payment_error]);

    // Example: Find the corresponding order and mark it as failed
    // $order = App\Models\Order::where('payment_intent_id', $paymentIntent->id)->first();
    // if ($order) {
    //     $order->update(['status' => 'payment_failed']);
    // }
}

protected function handleCheckoutSessionCompleted($session)
{
    // Log or process the completed checkout session
    Log::info('Checkout Session completed:', ['id' => $session->id, 'customer' => $session->customer_details]);

    // This event is common when using Stripe Checkout.
    // You can retrieve information from the session, like customer details,
    // and the associated Payment Intent or Subscription.
    // Example: Find the order based on metadata attached to the session
    // $orderId = $session->metadata->order_id ?? null;
    // if ($orderId) {
    //     $order = App\Models\Order::find($orderId);
    //     if ($order) {
    //         $order->update(['status' => 'paid', 'stripe_checkout_session_id' => $session->id]);
    //     }
    // }
} 
}
