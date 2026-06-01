<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\MealPhotoController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RatingController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn () => Inertia::render('Dinein&Takeout', [
    'canLogin' => Route::has('login'),
    'canRegister' => Route::has('register'),
]))->name('welcome');

Route::get('/bulk', fn () => Inertia::render('Welcome', [
    'canLogin' => Route::has('login'),
    'canRegister' => Route::has('register'),
]))->name('dining&takeout');

Route::get('/bakery', fn () => Inertia::render('Bakery', [
    'canLogin' => Route::has('login'),
    'canRegister' => Route::has('register'),
]))->name('bakery');

Route::get('/catering', fn () => Inertia::render('Catering', [
    'canLogin' => Route::has('login'),
    'canRegister' => Route::has('register'),
]))->name('catering');

Route::get('/dine-in', fn () => Inertia::render('Dinein', [
    'canLogin' => Route::has('login'),
    'canRegister' => Route::has('register'),
]))->name('dining');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', fn () => Inertia::render('Dashboard'))->name('dashboard');

    Route::resource('/orders', OrderController::class);
    Route::resource('/meals', MealController::class);
    Route::resource('/reservations', ReservationController::class);
    Route::resource('/ratings', RatingController::class);

    Route::get('/api/order-stats', [AdminController::class, 'getOrderStats']);
    Route::get('/api/get-orders', [OrderController::class, 'getOrder'])->name('getorder');
    Route::get('/api/get-reservations', [ReservationController::class, 'getReservation'])->name('getreservation');

    Route::post('/meals/{meal}/rate', [RatingController::class, 'rateMeal'])->name('rate.meal');
});

Route::resource('/meal-photos', MealPhotoController::class);

Route::get('/checkout/success', fn () => Inertia::render('Payment/Success'))->name('checkout.success');
