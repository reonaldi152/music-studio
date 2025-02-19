@extends('layouts.app')

@section('title', 'Tentang Kami - MD Music Studio')

@section('content')

    <section class="py-16 bg-gray-900">
        <div class="container px-6 mx-auto text-center">
            <h2 class="text-4xl font-extrabold text-white">Tentang Kami</h2>
            <p class="max-w-2xl mx-auto mt-4 text-lg text-gray-300">
                MD Music Studio adalah studio musik profesional dengan fasilitas terbaik untuk rekaman dan latihan musik
                Anda.
            </p>
            <div class="flex justify-center mt-6">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/Gqrv_WfdY6U?si=Bz_8n6FA9to7cKg1"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        </div>
    </section>

@endsection
