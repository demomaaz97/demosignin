<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\api\LighthouseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');
Route::get('auth/google/redirect', [AuthController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
Route::post('test-lighthouse', [LighthouseController::class, 'testPerformance']);


