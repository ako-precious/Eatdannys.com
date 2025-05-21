<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

// routes/web.php
// Auth::routes(['reset' => true]); // This enables password reset routes

Route::get('/payment-status',[PaymentController::class, 'createPaymentIntent'])->name('payment.status');
Route::get('/checkout/success', function () {
    return Inertia::render('Payment/Success',);})->name('success');


// Create a simple Blade view for payment status (resources/views/payment-status.blade.php)
// You could also use a Vue component for this page if you prefer SPA routing.