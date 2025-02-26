<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // public function createBooking(Request $request)
    // {
    //     $validated = $request->validate([
    //         'user_id' => 'required|exists:users,id',
    //         'studio_id' => 'nullable|exists:studios,id',
    //         'add_recording' => 'nullable|boolean',
    //         'music_equipment' => 'nullable|array',
    //     ]);

    //     Log::info('✅ Data Booking Sebelum Perhitungan:', $validated);

    //     // Inisialisasi total harga
    //     $totalPrice = 0;

    //     // Tambahkan biaya rekaman jika dipilih
    //     if (!empty($validated['add_recording']) && $validated['add_recording']) {
    //         Log::info('✅ Rekaman dipilih, menambahkan Rp 200.000');
    //         $totalPrice += 200000;
    //     }

    //     // Tambahkan biaya alat musik per item (Rp 50.000 per alat)
    //     if (!empty($validated['music_equipment'])) {
    //         Log::info('✅ Alat musik yang dipilih:', ['equipment' => $validated['music_equipment']]);
    //         $totalPrice += count($validated['music_equipment']) * 50000;
    //     }

    //     // Simpan nilai total_price sebelum masuk ke database
    //     $validated['total_price'] = $totalPrice;
    //     $validated['booking_code'] = 'BOOK-' . strtoupper(uniqid());

    //     Log::info('✅ Harga Akhir yang Akan Disimpan: ' . $validated['total_price']);

    //     $booking = Booking::create($validated);

    //     Log::info('✅ Booking berhasil disimpan:', ['booking' => Booking::find($booking->id)]);

    //     return response()->json([
    //         'message' => 'Booking berhasil dibuat',
    //         'booking' => $booking
    //     ]);
    // }


    public function index()
    {
        $studios = Studio::all();
        return view('booking.index', compact('studios'));
    }

    /**
     * Menampilkan form booking untuk studio yang dipilih.
     */
    public function create($studio_id)
    {
        $studio = Studio::findOrFail($studio_id);
        return view('booking.create', compact('studio'));
    }

    /**
     * Menyimpan booking ke database dan redirect ke checkout.
     */
    public function store(Request $request)
    {
        $request->validate([
            'studio_id' => 'required|exists:studios,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'total_price' => 'required|numeric|min:0'
        ]);

        $studio = Studio::findOrFail($request->studio_id);
        $total_price = $studio->price_per_hour;

        if ($request->has('add_recording')) {
            $total_price += 1000;
        }

        if ($request->has('music_equipment')) {
            $total_price += count($request->music_equipment) * 1000;
        }

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'studio_id' => $studio->id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'total_price' => $total_price,
            'status' => 'pending',
        ]);

        return redirect()->route('booking.checkout', ['id' => $booking->id]);
    }



    /**
     * Menampilkan halaman checkout.
     */
    // public function checkout($id)
    // {
    //     $booking = Booking::with('studio')->findOrFail($id);

    //     // Konfigurasi Midtrans
    //     Config::$serverKey = env('MIDTRANS_SERVER_KEY');
    //     Config::$isProduction = false;
    //     Config::$isSanitized = true;
    //     Config::$is3ds = true;

    //     // Jika sudah punya snap token, gunakan kembali
    //     if (!$booking->snap_token) {
    //         $transaction = [
    //             'transaction_details' => [
    //                 'order_id' => $booking->id,
    //                 'gross_amount' => $booking->total_price,
    //             ],
    //             'customer_details' => [
    //                 'email' => Auth::user()->email,
    //             ],
    //         ];

    //         $snapToken = Snap::getSnapToken($transaction);
    //         $booking->snap_token = $snapToken;
    //         $booking->save();
    //     }

    //     return view('booking.checkout', compact('booking'));
    // }

    public function checkout($id)
{
    $booking = Booking::with('studio')->findOrFail($id);
    return view('booking.checkout', compact('booking'));
}

    /**
     * Callback dari Midtrans setelah pembayaran.
     */
    public function callback(Request $request)
    {
        $booking = Booking::findOrFail($request->order_id);

        if ($request->transaction_status == 'settlement') {
            $booking->status = 'paid';
        } elseif ($request->transaction_status == 'cancel') {
            $booking->status = 'canceled';
        }

        $booking->save();
    }

}
