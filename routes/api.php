<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\api\LighthouseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('auth')->group(function () {
    Route::get('/google/redirect', [AuthController::class, 'redirectToGoogle']);
    Route::get('/google/callback', [AuthController::class, 'handleGoogleCallback']);
});

Route::post('/test-lighthouse', [LighthouseController::class, 'testPerformance']);

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
});


