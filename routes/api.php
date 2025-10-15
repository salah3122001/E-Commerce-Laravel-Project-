<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartApiController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\ProductApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/products', [ProductApiController::class, 'index']);
Route::get('/products/{id}', [ProductApiController::class, 'show']);
Route::post('/products', [ProductApiController::class, 'store']);
Route::put('/products/{id}', [ProductApiController::class, 'update']);
Route::delete('/products/{id}', [ProductApiController::class, 'destroy']);

Route::get('/categories', [CategoryApiController::class, 'index']);
Route::get('/categories/{id}', [CategoryApiController::class, 'show']);
Route::post('/categories', [CategoryApiController::class, 'store']);
Route::put('/categories/{id}', [CategoryApiController::class, 'update']);
Route::delete('/categories/{id}', [CategoryApiController::class, 'destroy']);





Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/carts', [CartApiController::class, 'show']);
    Route::post('/carts', [CartApiController::class, 'store']);
    Route::put('/carts/{id}', [CartApiController::class, 'update']);
    Route::delete('/carts/{id}', [CartApiController::class, 'destroy']);
    Route::delete('/carts', [CartApiController::class, 'clear']);

    Route::get('/orders', [OrderApiController::class, 'index']);
    Route::post('/orders', [OrderApiController::class, 'store']);
    Route::get('/orders/{id}', [OrderApiController::class, 'show']);
    Route::delete('/orders/{id}', [OrderApiController::class, 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/logoutall', [AuthController::class, 'logoutall']);
});
