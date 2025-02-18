<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Booking;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function __construct()
    {
        // Set konfigurasi Midtrans
        Config::$serverKey    = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized  = config('services.midtrans.isSanitized');
        Config::$is3ds        = config('services.midtrans.is3ds');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // Generate unique transaction ID
            $transactionId = 'TRX-' . Str::upper(Str::random(10));

            // Dapatkan ID booking dari request
            $bookingId = $request->booking_id;

            // Ambil data booking
            $booking = Booking::findOrFail($bookingId);

            // Buat transaksi baru
            $transaction = Transaction::create([
                'transaction_id' => $transactionId,
                'user_id'        => Auth::id(),
                'studio_id'      => $booking->studio_id,
                'booking_id'     => $booking->id,
                'total_price'    => $booking->total_price,
                'status'         => 'pending',
            ]);

            // Buat payload Midtrans
            $payload = [
                'transaction_details' => [
                    'order_id'      => $transaction->id,
                    'gross_amount'  => $transaction->total_price,
                ],
                'customer_details' => [
                    'first_name'       => Auth::user()->name,
                    'email'            => Auth::user()->email,
                    'phone'            => Auth::user()->phone ?? '08123456789', // Tambahkan default jika tidak ada
                ],
                'item_details' => [
                    [
                        'id'       => $booking->id,
                        'price'    => $booking->total_price,
                        'quantity' => 1,
                        'name'     => 'Booking Studio ' . $booking->studio->name,
                    ]
                ]
            ];

            // Generate Snap Token
            $snapToken = Snap::getSnapToken($payload);

            // Buat URL pembayaran
            $baseSnapUrl = config('services.midtrans.isProduction')
                ? 'https://app.midtrans.com/snap/v2/vtweb/'
                : 'https://app.sandbox.midtrans.com/snap/v2/vtweb/';

            $paymentUrl = $baseSnapUrl . $snapToken;

            // Simpan snap token dan URL pembayaran dalam transaksi
            $transaction->update([
                'payment_url' => $paymentUrl,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil dibuat',
                'payment_url' => $paymentUrl,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat transaksi',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function notificationHandler(Request $request)
    {
        $payload = $request->getContent();
        $notification = json_decode($payload);

        // Validasi Signature Key
        $validSignatureKey = hash("sha512", $notification->order_id . $notification->status_code . $notification->gross_amount . config('services.midtrans.serverKey'));

        if ($notification->signature_key != $validSignatureKey) {
            return response(['message' => 'Invalid signature'], 403);
        }

        $transactionStatus = $notification->transaction_status;
        $orderId = $notification->order_id;

        $transaction = Transaction::where('id', $orderId)->first();

        if (!$transaction) {
            return response(['message' => 'Transaction not found'], 404);
        }

        // Update status transaksi berdasarkan Midtrans
        switch ($transactionStatus) {
            case 'capture':
            case 'settlement':
                $transaction->status = 'paid';
                $transaction->booking->update(['status' => 'paid']);
                break;
            case 'pending':
                $transaction->status = 'pending';
                break;
            case 'deny':
            case 'expire':
            case 'cancel':
                $transaction->status = 'failed';
                break;
        }

        $transaction->save();

        return response()->json(['message' => 'Notification processed successfully.']);
    }
}
