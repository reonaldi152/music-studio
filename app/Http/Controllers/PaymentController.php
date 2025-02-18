<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id'
        ]);

        // Set konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false; // Ganti ke true jika sudah live
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Ambil data booking
        $booking = Booking::with('user')->findOrFail($request->booking_id);

        // Pastikan booking memiliki harga (gross_amount)
        if (!$booking->amount || $booking->amount <= 0) {
            return response()->json(['error' => 'Invalid booking amount'], 400);
        }

        // Parameter transaksi Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => 'BOOKING-' . $booking->id . '-' . time(),
                'gross_amount' => $booking->amount,
            ],
            'customer_details' => [
                'email' => $booking->user->email ?? 'customer@example.com',
                'first_name' => $booking->user->name ?? 'Customer',
            ],
        ];

        try {
            // Dapatkan Snap Token dari Midtrans
            $snapToken = Snap::getSnapToken($params);

            // Simpan transaksi ke dalam tabel `payments`
            $payment = Payment::create([
                'user_id' => $booking->user_id,
                'booking_id' => $booking->id,
                'transaction_id' => $params['transaction_details']['order_id'],
                'status' => 'pending',
                'amount' => $booking->amount,
            ]);

            return response()->json([
                'snap_token' => $snapToken,
                'payment_id' => $payment->id,
                'transaction_id' => $payment->transaction_id
            ]);
        } catch (\Exception $e) {
            Log::error('Midtrans Payment Error: ' . $e->getMessage());
            return response()->json(['error' => 'Payment initiation failed'], 500);
        }
    }

    public function handleNotification(Request $request)
    {
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $rawBody = file_get_contents('php://input');
        $signatureKey = hash("sha512", $rawBody . $serverKey);

        $notification = json_decode($rawBody, true);

        if ($notification['signature_key'] !== $signatureKey) {
            return response()->json(['error' => 'Invalid signature'], 403);
        }

        $transactionStatus = $notification['transaction_status'];
        $orderId = $notification['order_id'];

        // Cari pembayaran berdasarkan transaction_id
        $payment = Payment::where('transaction_id', $orderId)->first();

        if (!$payment) {
            return response()->json(['error' => 'Payment not found'], 404);
        }

        // Update status pembayaran berdasarkan status dari Midtrans
        if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
            $payment->status = 'paid';
        } elseif ($transactionStatus == 'pending') {
            $payment->status = 'pending';
        } elseif ($transactionStatus == 'cancel' || $transactionStatus == 'expire' || $transactionStatus == 'failure') {
            $payment->status = 'failed';
        }

        $payment->save();

        return response()->json(['message' => 'Payment status updated']);
    }
}
