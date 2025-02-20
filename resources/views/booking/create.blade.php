@extends('layouts.app')

@section('title', 'Buat Pemesanan')

@section('content')

    <section class="py-20 bg-gray-900">
        <div class="container px-6 mx-auto text-center">
            <h2 class="text-4xl font-extrabold text-white">Pemesanan Studio {{ $studio->name }}</h2>
            <p class="max-w-2xl mx-auto mt-4 text-lg text-gray-300">
                Silakan lakukan pemesanan untuk melanjutkan ke pembayaran.
            </p>

            <div class="max-w-lg p-6 mx-auto mt-8 text-left bg-gray-800 shadow-xl rounded-xl">
                @if ($errors->any())
                    <div class="p-4 mb-4 text-white bg-red-500 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>⚠️ {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('booking.store') }}" method="POST" id="booking-form">
                    @csrf
                    <input type="hidden" name="studio_id" value="{{ $studio->id }}">
                    <input type="hidden" name="total_price" id="total_price_input" value="{{ $studio->price_per_hour }}">

                    <!-- Harga Studio -->
                    <div class="flex justify-between text-xl font-semibold text-white">
                        <span>Harga Studio per Jam:</span>
                        <span id="studio-price" class="text-green-400">
                            Rp {{ number_format($studio->price_per_hour, 0, ',', '.') }}
                        </span>
                    </div>

                    <!-- Pilih Waktu Booking -->
                    <div class="mt-6">
                        <label class="text-lg font-semibold text-white" for="start_time">Waktu Mulai:</label>
                        <input type="datetime-local" name="start_time" id="start_time" required
                            class="w-full px-4 py-2 mt-2 text-gray-800 bg-white rounded-lg shadow-md focus:outline-none">
                    </div>
                    <div class="mt-4">
                        <label class="text-lg font-semibold text-white" for="end_time">Waktu Selesai:</label>
                        <input type="datetime-local" name="end_time" id="end_time" required
                            class="w-full px-4 py-2 mt-2 text-gray-800 bg-white rounded-lg shadow-md focus:outline-none">
                    </div>

                    <!-- Tambahan Opsi -->
                    <div class="mt-6">
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" name="add_recording" id="add_recording" value="200000"
                                class="w-5 h-5 text-red-600 form-checkbox">
                            <span class="text-lg text-gray-300">Tambahkan Rekaman (Rp 200.000)</span>
                        </label>
                    </div>

                    <!-- Pilihan Alat Musik -->
                    <div class="mt-6">
                        <p class="text-lg font-semibold text-white">Pilih Alat Musik (Rp 50.000 per alat)</p>
                        <div class="grid grid-cols-2 gap-4 mt-3">
                            @php
                                $equipmentList = ['Gitar', 'Ampli', 'Keyboard'];
                            @endphp
                            @foreach ($equipmentList as $equipment)
                                <label
                                    class="flex items-center p-3 space-x-3 transition bg-gray-700 rounded-lg cursor-pointer hover:bg-gray-600">
                                    <input type="checkbox" name="music_equipment[]" value="50000"
                                        class="w-5 h-5 text-red-600 form-checkbox equipment">
                                    <span class="text-lg text-gray-300">{{ $equipment }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Total Harga -->
                    <div class="flex justify-between pt-4 mt-6 text-xl font-bold text-white border-t border-gray-600">
                        <span>Total Harga:</span>
                        <span id="total-price" class="text-yellow-400">
                            Rp {{ number_format($studio->price_per_hour, 0, ',', '.') }}
                        </span>
                    </div>

                    <!-- Tombol Checkout -->
                    <button type="submit"
                        class="w-full px-6 py-3 mt-6 text-lg font-semibold transition duration-300 bg-blue-600 rounded-lg shadow-lg hover:bg-blue-700 hover:shadow-xl">
                        Lanjut ke Checkout →
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Script untuk Update Total Harga -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addRecording = document.getElementById('add_recording');
            const equipmentCheckboxes = document.querySelectorAll('.equipment');
            const totalPriceElement = document.getElementById('total-price');
            const totalPriceInput = document.getElementById('total_price_input');

            if (!addRecording || !totalPriceElement || !totalPriceInput) return;

            let basePrice = parseFloat({{ $studio->price_per_hour }});

            function calculateTotal() {
                let total = basePrice;

                if (addRecording.checked) {
                    total += parseFloat(addRecording.value);
                }

                equipmentCheckboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        total += parseFloat(checkbox.value);
                    }
                });

                totalPriceElement.textContent = `Rp ${total.toLocaleString('id-ID')}`;
                totalPriceInput.value = total;
            }

            addRecording.addEventListener('change', calculateTotal);
            equipmentCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', calculateTotal);
            });

            calculateTotal();
        });
    </script>

@endsection
