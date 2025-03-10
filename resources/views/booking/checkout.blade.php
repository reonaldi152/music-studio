@extends('layouts.app')

@section('title', 'Checkout')

@section('content')

    <section class="py-16 bg-lightDark">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-white">Checkout</h2>
            <p class="mt-4 text-lg text-gray-300">
                Total Pembayaran: Rp {{ number_format($booking->total_price, 0, ',', '.') }}
            </p>

            <button id="pay-button"
                class="px-6 py-3 mt-6 text-lg font-semibold transition duration-300 bg-red-600 rounded-lg hover:bg-red-700">
                Bayar Sekarang
            </button>
        </div>
    </section>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const payButton = document.getElementById("pay-button");

            if (!payButton) return;

            payButton.addEventListener("click", async function() {
                try {
                    const response = await fetch("{{ route('payment.create') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            booking_id: "{{ $booking->id }}"
                        })
                    });

                    if (!response.ok) {
                        throw new Error("Gagal mendapatkan respons dari server.");
                    }

                    const data = await response.json();

                    if (data.snap_token) {
                        snap.pay(data.snap_token);
                    } else {
                        alert("Gagal mendapatkan token pembayaran.");
                    }
                } catch (error) {
                    console.error("Error:", error);
                    alert("Terjadi kesalahan. Silakan coba lagi.");
                }
            });
        });
    </script>

@endsection
