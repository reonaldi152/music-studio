@extends('layouts.app')

@section('title', 'Buat Pemesanan')

@section('content')

<section class="py-16 bg-lightDark">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl font-bold text-white">Pemesanan Studio {{ $studio->name }}</h2>
        <p class="mt-4 text-lg text-gray-300">Silakan lakukan pemesanan untuk melanjutkan ke pembayaran.</p>

        <form action="{{ route('booking.store') }}" method="POST">
            @csrf
            <input type="hidden" name="studio_id" value="{{ $studio->id }}">
            <button type="submit"
                class="px-6 py-3 mt-6 text-lg font-semibold bg-red-600 rounded-lg hover:bg-red-700">
                Lanjut ke Checkout
            </button>
        </form>
    </div>
</section>

@endsection
