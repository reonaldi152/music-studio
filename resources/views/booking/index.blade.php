@extends('layouts.app')

@section('title', 'Pemesanan - MD Music Studio')

@section('content')

    <!-- Pilih Layanan Section -->
    <section class="py-20 bg-gray-900">
        <div class="container px-6 mx-auto text-center">
            <h2 class="text-4xl font-extrabold text-white">Pilih Layanan</h2>
            <p class="max-w-2xl mx-auto mt-4 text-lg text-gray-300">
                Kami menyediakan berbagai layanan untuk kebutuhan rekaman dan latihan musik.
            </p>
            <div class="grid grid-cols-1 gap-10 mt-12 md:grid-cols-3">

                <!-- Loop Studio -->
                @foreach ($studios as $studio)
                    <div
                        class="relative overflow-hidden transition-all duration-300 bg-gray-800 shadow-xl rounded-xl group hover:scale-105 hover:shadow-2xl">
                        <div class="relative">
                            <img src="{{ asset('storage/' . $studio->image) }}" alt="Studio Musik"
                                class="object-cover w-full h-56 transition-opacity duration-300 rounded-t-xl brightness-75 group-hover:brightness-90">
                            <div
                                class="absolute inset-0 opacity-75 bg-gradient-to-t from-black to-transparent group-hover:opacity-50">
                            </div>
                        </div>

                        <div class="p-6 text-left">
                            <h3 class="text-2xl font-bold text-white">{{ $studio->name }}</h3>
                            <p class="mt-1 text-sm text-gray-300">{{ $studio->description }}</p>
                            <p class="mt-2 text-sm font-semibold text-gray-400">Harga: Rp
                                {{ number_format($studio->price_per_hour, 0, ',', '.') }} / jam</p>

                            <!-- Menampilkan Waktu Booking -->
                            @if ($studio->bookings->count() > 0)
                                <div class="mt-3 text-sm font-semibold text-red-400">
                                    <p>Jadwal Terisi:</p>
                                    @foreach ($studio->bookings as $booking)
                                        <p>- {{ \Carbon\Carbon::parse($booking->start_time)->format('d M Y H:i') }} -
                                            {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}</p>
                                    @endforeach
                                </div>
                            @else
                                <p class="mt-2 text-sm font-semibold text-green-400">Studio tersedia untuk booking!</p>
                            @endif

                            <!-- Tombol Booking -->
                            <a href="{{ route('booking.create', ['studio' => $studio->id]) }}"
                                class="inline-block w-full px-5 py-3 mt-4 text-lg font-semibold text-center text-white transition duration-300 bg-blue-600 rounded-lg shadow-lg hover:bg-blue-700 hover:shadow-xl">
                                Book Now →
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

@endsection
