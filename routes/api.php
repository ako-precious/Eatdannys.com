<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealController;
use App\Http\Controllers\WebhookController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/meal', [MealController::class, 'index']);

// routes/api.php or routes/web.php
Route::post('/stripe/webhook', [WebhookController::class, 'handleWebhook']);
