@extends('layouts.app')

@section('title', 'Beranda - MD Music Studio')

@section('content')

<!-- Hero Section -->
<section class="relative flex items-center justify-center h-screen">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    <img src="{{ asset('images/hero.png') }}" alt="Studio Musik"
        class="absolute inset-0 object-cover w-full h-full">
    <div class="relative text-center">
        <h1 class="text-4xl font-bold md:text-6xl">Selamat Datang di MD Music Studio</h1>
        <p class="mt-4 text-lg md:text-xl">Tempat terbaik untuk rekaman dan latihan musik Anda</p>
        {{-- <a href="{{ route('booking.index') }}"
            class="inline-block px-6 py-3 mt-6 text-lg font-semibold bg-red-600 rounded-lg hover:bg-red-700">
            Pesan Sekarang
        </a> --}}
        <a href=""
            class="inline-block px-6 py-3 mt-6 text-lg font-semibold bg-red-600 rounded-lg hover:bg-red-700">
            Pesan Sekarang
        </a>
    </div>
</section>

@endsection
