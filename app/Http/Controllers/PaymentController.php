<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Booking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $booking = Booking::findOrFail($request->booking_id);
        $params = [
            'transaction_details' => [
                'order_id' => $booking->id,
                'gross_amount' => $booking->amount,
            ],
            'customer_details' => [
                'email' => $booking->user->email,
                'first_name' => $booking->user->name,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json(['snap_token' => $snapToken]);
    }
}

