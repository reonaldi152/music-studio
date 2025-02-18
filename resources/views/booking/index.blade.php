@extends('layouts.app')

@section('title', 'Pemesanan - MD Music Studio')

@section('content')

<!-- Pilih Layanan Section -->
<section class="py-16 bg-lightDark">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl font-bold text-white">Pilih Layanan</h2>
        <p class="mt-4 text-lg text-gray-300">Kami menyediakan berbagai layanan untuk kebutuhan rekaman dan latihan musik</p>
        <div class="grid grid-cols-1 gap-8 mt-12 md:grid-cols-3">
            
            <!-- Loop Studio -->
            @foreach($studios as $studio)
            <div class="relative overflow-hidden bg-gray-800 rounded-lg shadow-lg group">
                <img src="{{asset('storage/' . $studio->image) }}" alt="Studio Musik"
                    class="object-cover w-full h-64 transition duration-300 group-hover:scale-105 group-hover:opacity-80">
                <div class="absolute inset-0 bg-black opacity-40"></div>
                <div class="absolute text-white bottom-6 left-6">
                    <h3 class="text-2xl font-bold">{{ $studio->name }}</h3>
                    <p class="mt-2">{{ $studio->description }}</p>
                    <a href="{{ route('booking.create', ['studio' => $studio->id]) }}"
                        class="inline-block mt-2 text-lg font-medium text-primary hover:underline">
                        Book Now →
                    </a>
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
</section>

@endsection
