<?php

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\DocumentsController;
use App\Http\Controllers\Api\QuotationController;
use App\Http\Controllers\Api\ServiceController; 
use App\Http\Controllers\Api\DemoController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::apiResource('demo', DemoController::class);
// Route::apiResource('quotations', QuotationController::class ); 
// Route::apiResource('services', ServiceController::class);

// Auth Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::apiResource('customers', CustomerController::class);
Route::apiResource('documents', DocumentsController::class)->middleware('auth:sanctum');
Route::get('/users', [AuthController::class, 'index'])->middleware('auth:sanctum');

