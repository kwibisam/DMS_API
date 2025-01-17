<?php

use App\Http\Controllers\Api\ExampleController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\DocumentsController;
use App\Http\Controllers\Api\TagsController;
use App\Http\Controllers\Api\QuotationController;
use App\Http\Controllers\Api\ServiceController; 
use App\Http\Controllers\Api\DemoController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Auth Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/users', [AuthController::class, 'index'])->middleware('auth:sanctum');

Route::apiResource('example', ExampleController::class);
Route::apiResource('customers', CustomerController::class);
Route::apiResource('tags', TagsController::class);
Route::apiResource('demo', DemoController::class);
Route::apiResource('documents', DocumentsController::class)->middleware('auth:sanctum');


