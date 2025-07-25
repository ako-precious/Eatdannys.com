<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\MealPhotoController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReservationController;
use App\Models\Order;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Auth;



// Route::get('/linkstorage', function () {
//     Artisan::call('storage:link');
// });

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

Route::get('/dine-in&takeout', function () {
    return Inertia::render('Dinein&Takeout', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('dining&takeout');

Route::get('/bakery', function () {
    return Inertia::render('Bakery', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('bakery');

Route::get('/catering', function () {
    return Inertia::render('Catering', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('catering');

Route::get('/dine-in', function () {
    return Inertia::render('Dinein', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('dining');
// Route::get('/dine-in', function () {
//     return Inertia::render('404Page', );
// })->name('dining');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::resource('/orders',  OrderController::class);
    Route::resource('/meals',  MealController::class);
    Route::resource('/reservations',  ReservationController::class);

    
    Route::get('/api/order-stats', [AdminController::class, 'getOrderStats']);
    Route::get('/users', [AdminController::class, 'index']);
    Route::get('/api/get-orders',[OrderController::class,'getOrder'])->name('getorder');
    Route::get('/api/get-reservations',[ReservationController::class,'getReservation'])->name('getreservation');
});

// routes/web.php
// Auth::routes(['reset' => true]); // This enables password reset routes

Route::resource('/meal-photos',  MealPhotoController::class);
Route::get('/payment-status',[PaymentController::class, 'createPaymentIntent'])->name('payment.status');
Route::get('/checkout/success', function () {
    return Inertia::render('Payment/Success',);})->name('checkout.success');
 

// Create a simple Blade view for payment status (resources/views/payment-status.blade.php)
// You could also use a Vue component for this page if you prefer SPA routing.