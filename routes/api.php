<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('books', BookController::class);

Route::apiResource('categories', CategoryController::class);

Route::apiResource('orders', OrderController::class);
Route::get('orders/{order}/orderItems', [OrderController::class, 'getItems']);
Route::post('orders/{order}/orderItems', [OrderController::class, 'addItem']);
Route::delete('orders/{order}/orderItems/{orderItem}', [OrderController::class, 'removeItem']);
Route::put('orders/{order}/orderItems/{orderItem}', [OrderController::class, 'updateItem']);

Route::apiResource('users', UserController::class);
