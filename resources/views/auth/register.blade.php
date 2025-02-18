@extends('layouts.app')

@section('title', 'Register - MD Music Studio')

@section('content')

<div class="flex items-center justify-center min-h-screen bg-dark">
    <div class="w-full max-w-md p-8 bg-gray-900 rounded-lg shadow-md">
        <h2 class="mb-6 text-3xl font-bold text-center text-white">Daftar</h2>

        <!-- Form -->
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-300">Nama Lengkap</label>
                <input type="text" id="name" name="name" required
                    class="w-full px-4 py-2 mt-1 text-black bg-gray-200 rounded-lg focus:ring focus:ring-red-500">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                <input type="email" id="email" name="email" required
                    class="w-full px-4 py-2 mt-1 text-black bg-gray-200 rounded-lg focus:ring focus:ring-red-500">
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-2 mt-1 text-black bg-gray-200 rounded-lg focus:ring focus:ring-red-500">
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-300">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                    class="w-full px-4 py-2 mt-1 text-black bg-gray-200 rounded-lg focus:ring focus:ring-red-500">
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full px-4 py-2 text-lg font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700">
                Daftar
            </button>
        </form>

        <!-- Login Link -->
        <p class="mt-4 text-center text-gray-400">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-red-400 hover:underline">Masuk di sini</a>
        </p>
    </div>
</div>

@endsection
