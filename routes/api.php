<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\AuthApiController;

Route::post('/auth/register', [AuthApiController::class, 'register']);
Route::post('/auth/login', [AuthApiController::class, 'login']);
Route::post('/auth/logout', [AuthApiController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/auth/update-profile', [AuthApiController::class, 'updateProfile'])->middleware('auth:sanctum');


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('products')->group(function () {
    Route::get('/', [ProductApiController::class, 'index']);
    Route::get('/{id}', [ProductApiController::class, 'show']);
});
