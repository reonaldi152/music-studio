<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;

// Authentication Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes (Require Authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // Payment Routes
    Route::post('/payments', [PaymentController::class, 'createPayment']);
    Route::post('/payments/notification', [PaymentController::class, 'handleNotification']);

    // Booking Routes
    Route::post('/bookings', [BookingController::class, 'createBooking']);
    Route::get('/bookings/{userId}', [BookingController::class, 'getBookings']);

});

?>
