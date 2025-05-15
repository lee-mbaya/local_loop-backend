<?php

use App\Http\Controllers\BusinessController;
use Illuminate\Support\Facades\Route;

// Route to get all businesses
Route::get('/businesses', [BusinessController::class, 'index']);

// Route to store a new business
Route::post('/businesses', [BusinessController::class, 'store']);
Route::middleware('auth:sanctum')->get('/businesses', [BusinessController::class, 'index']);
Route::middleware('auth:sanctum')->post('/businesses', [BusinessController::class, 'store']);
