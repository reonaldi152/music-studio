<?php

use App\Models\Studio;
use App\Models\RecordingRoom;
use App\Models\MusicEquipment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Beranda (Home)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Tentang Kami
Route::get('/about', function () {
    return view('about');
})->name('about');

// Layanan
Route::get('/services', function () {
    return view('services');
})->name('services');

Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/booking/{studio}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/checkout/{id}', [BookingController::class, 'checkout'])->name('booking.checkout');
    Route::post('/midtrans-callback', [BookingController::class, 'callback']);

    Route::post('/payment/create', [PaymentController::class, 'createPayment'])->name('payment.create');
    Route::post('/payment/notification', [PaymentController::class, 'handleNotification']);

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});







