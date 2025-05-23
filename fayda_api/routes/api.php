<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\StoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Authentication
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);


//Route::resource('payment',PaymentController::class);
Route::apiResource('store',StoreController::class);
Route::post('store/{id}/change-status', [StoreController::class, 'changeStatus']);

Route::apiResource('item',ItemController::class);

Route::apiResource('order',OrderController::class);

Route::post('add-rating', [RatingController::class, 'store']);

