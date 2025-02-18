@extends('layouts.app')

@section('title', 'Profile - MD Music Studio')

@section('content')

<section class="py-16 bg-dark text-white">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl font-bold">Profil Saya</h2>
        <p class="mt-4 text-lg text-gray-300">Informasi akun Anda</p>

        <div class="mt-8 bg-gray-800 p-6 rounded-lg shadow-lg w-1/2 mx-auto text-left">
            <p class="text-lg"><strong>Nama:</strong> {{ $user->name }}</p>
            <p class="text-lg"><strong>Email:</strong> {{ $user->email }}</p>
            <p class="text-lg"><strong>Bergabung sejak:</strong> {{ $user->created_at->format('d M Y') }}</p>

            <a href="{{ route('home') }}" class="mt-4 inline-block px-6 py-3 bg-blue-600 rounded-lg hover:bg-blue-700">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</section>

@endsection
