@extends('layouts.app')

@section('title', 'Login - MD Music Studio')

@section('content')

<div class="flex items-center justify-center min-h-screen bg-dark">
    <div class="w-full max-w-md p-8 bg-gray-900 rounded-lg shadow-md">
        <h2 class="mb-6 text-3xl font-bold text-center text-white">Login</h2>

        <!-- Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
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

            <!-- Remember Me -->
            <div class="flex items-center justify-between mb-4">
                <label class="flex items-center text-sm text-gray-300">
                    <input type="checkbox" name="remember" class="mr-2 text-red-500">
                    Ingat Saya
                </label>
                
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full px-4 py-2 text-lg font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700">
                Login
            </button>
        </form>

        <!-- Register Link -->
        <p class="mt-4 text-center text-gray-400">
            Belum punya akun? <a href="{{ route('register') }}" class="text-red-400 hover:underline">Daftar di sini</a>
        </p>
    </div>
</div>

@endsection
