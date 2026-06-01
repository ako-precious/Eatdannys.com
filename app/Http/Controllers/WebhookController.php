<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Webhook;
use UnexpectedValueException;

class WebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature', '');
        $endpointSecret = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $endpointSecret);
        } catch (UnexpectedValueException) {
            return response('Invalid Payload', 400);
        } catch (SignatureVerificationException) {
            return response('Invalid Signature', 400);
        }

        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;
            Log::info("Payment success for session: {$session->id}");
        }

        return response('Webhook Handled', 200);
    }
}
