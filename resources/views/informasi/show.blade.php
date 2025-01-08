@extends('layouts.main')

@section('title', $informasi->judul)

@section('content')
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold text-blue-600 text-center">{{ $informasi->judul }}</h1>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mt-4 md:mt-8">
                <a href="/"
                   class="text-primary text-sm sm:text-base">
                    ← Kembali ke Home
                </a>
            </div>
        <div class="mt-8">
            @if($informasi->gambar)
                <img src="{{ asset('storage/' . $informasi->gambar) }}" alt="{{ $informasi->judul }}" class="mt-6 w-full h-96 object-cover rounded-lg">
            @else
                <p class="text-gray-500 mt-2">Tidak ada gambar</p>
            @endif
            <p class="text-lg text-gray-600">{!! nl2br(($informasi->konten)) !!}</p>

        </div>
    </div>
@endsection
