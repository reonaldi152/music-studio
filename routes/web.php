<?php

use App\Models\Studio;
use App\Models\RecordingRoom;
use App\Models\MusicEquipment;
use Illuminate\Support\Facades\Route;

// Landing page
Route::get('/', function () {
    return view('landing', [
        'studios' => Studio::all(),
        'recordingRooms' => RecordingRoom::all(),
        'equipments' => MusicEquipment::all(),
    ]);
})->name('landing');

// About page
Route::get('/tentang-kami', function () {
    return view('about');
})->name('about');

// Services page
Route::get('/layanan', function () {
    return view('services');
})->name('services');

// Booking page
Route::get('/pemesanan', function () {
    return view('booking', [
        'studios' => Studio::all(),
        'recordingRooms' => RecordingRoom::all(),
        'equipments' => MusicEquipment::all(),
    ]);
})->name('booking');

// Process the booking (submit form)
Route::post('/pemesanan', function (\Illuminate\Http\Request $request) {
    // Validasi data booking
    $request->validate([
        'studio_id' => 'required|exists:studios,id',
        'recording_room_id' => 'required|exists:recording_rooms,id',
        'equipment_id' => 'required|exists:music_equipments,id',
        'user_id' => 'required|exists:users,id',
        // Tambahkan validasi lainnya sesuai kebutuhan
    ]);

    // Logika untuk memproses pemesanan (bisa disesuaikan)
    $booking = \App\Models\Booking::create([
        'studio_id' => $request->studio_id,
        'recording_room_id' => $request->recording_room_id,
        'equipment_id' => $request->equipment_id,
        'user_id' => $request->user_id,
        'status' => 'pending', // Status pemesanan (Pending, Paid, Canceled)
    ]);

    // Redirect ke halaman konfirmasi atau status pemesanan
    return redirect()->route('booking')->with('success', 'Pemesanan berhasil dibuat!');
})->name('booking.store');

// Login route
Route::get('/login', function () {
    return redirect('/');
})->name('login');

// Register route
Route::get('/register', function () {
    return redirect('/');
})->name('register');

// Logout route
Route::post('/logout', function () {
    // Logic untuk logout
})->name('logout');

// Dummy booking (for testing)
Route::get('/dummy-booking', function () {
    return "Fitur booking belum tersedia.";
})->name('booking.create');

