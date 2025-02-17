<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function createBooking(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'studio_id' => 'nullable|exists:studios,id',
            'recording_room_id' => 'nullable|exists:recording_rooms,id',
            'equipment_id' => 'nullable|exists:music_equipments,id',
        ]);

        $booking = Booking::create($validated);

        return response()->json([
            'message' => 'Booking berhasil dibuat',
            'booking' => $booking
        ]);
    }

    public function getBookings($userId)
    {
        $bookings = Booking::where('user_id', $userId)->get();
        return response()->json($bookings);
    }
}

