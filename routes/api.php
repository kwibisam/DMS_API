<?php

use App\Http\Controllers\Api\QuotationController;
use App\Http\Controllers\Api\ServiceRequestController; 
use App\Http\Controllers\Api\DemoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('demo', DemoController::class);
Route::apiResource('quotation', QuotationController::class ); 
Route::apiResource('service', ServiceRequestController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


