<?php

use App\Http\Controllers\Api\QuotationController;
use App\Http\Controllers\Api\ServiceController; 
use App\Http\Controllers\Api\DemoController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('demo', DemoController::class);
Route::apiResource('quotations', QuotationController::class ); 
Route::apiResource('services', ServiceController::class);

ROUTE::post('/register',[AuthController::class, 'register']);
ROUTE::post('/login',[AuthController::class, 'login']);
ROUTE::post('/logout',[AuthController::class, 'logout']);

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


