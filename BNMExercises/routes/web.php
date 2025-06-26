<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HotelController;

// Auth
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// Protected (requires auth)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return response()->json(['message' => 'Welcome to your dashboard!']);
    });

    Route::get('/hotels', [HotelController::class, 'index']);
    Route::post('/hotels', [HotelController::class, 'store']);
    Route::get('/hotels/{hotel}', [HotelController::class, 'show']);
    Route::put('/hotels/{hotel}', [HotelController::class, 'update']);
    Route::delete('/hotels/{hotel}', [HotelController::class, 'destroy']);
});

