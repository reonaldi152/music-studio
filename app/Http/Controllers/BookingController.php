<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function createBooking(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'studio_id' => 'nullable|exists:studios,id',
            'add_recording' => 'nullable|boolean',
            'music_equipment' => 'nullable|array',
        ]);

        Log::info('✅ Data Booking Sebelum Perhitungan:', $validated);

        // Inisialisasi total harga
        $totalPrice = 0;

        // Tambahkan biaya rekaman jika dipilih
        if (!empty($validated['add_recording']) && $validated['add_recording']) {
            Log::info('✅ Rekaman dipilih, menambahkan Rp 200.000');
            $totalPrice += 200000;
        }

        // Tambahkan biaya alat musik per item (Rp 50.000 per alat)
        if (!empty($validated['music_equipment'])) {
            Log::info('✅ Alat musik yang dipilih:', ['equipment' => $validated['music_equipment']]);
            $totalPrice += count($validated['music_equipment']) * 50000;
        }

        // Simpan nilai total_price sebelum masuk ke database
        $validated['total_price'] = $totalPrice;
        $validated['booking_code'] = 'BOOK-' . strtoupper(uniqid());

        Log::info('✅ Harga Akhir yang Akan Disimpan: ' . $validated['total_price']);

        $booking = Booking::create($validated);

        Log::info('✅ Booking berhasil disimpan:', ['booking' => Booking::find($booking->id)]);

        return response()->json([
            'message' => 'Booking berhasil dibuat',
            'booking' => $booking
        ]);
    }

}
