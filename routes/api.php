<?php

use App\Http\Controllers\MealController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\WebhookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', fn (Request $request) => $request->user())->middleware('auth:sanctum');

Route::get('/meal', [MealController::class, 'getMeals']);
Route::get('/dine-meal', [MealController::class, 'getDineMeals']);

Route::post('/stripe/webhook', [WebhookController::class, 'handleWebhook']);

Route::post('/create-checkout-session', [PaymentController::class, 'createSession']);
Route::get('/checkout/success', [PaymentController::class, 'success'])->name('api.checkout.success');
Route::get('/checkout/cancel', [PaymentController::class, 'cancel'])->name('api.checkout.cancel');

Route::get('/get-orders', [OrderController::class, 'getOrder']);

Route::post('/reservations', [ReservationController::class, 'store']);

Route::get('/stripe-key', fn () => response()->json([
    'stripePublicKey' => config('services.stripe.key'),
]));
