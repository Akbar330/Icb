@extends('layouts.main')

@section('title', $beritas->judul)

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mt-4 md:mt-8">
                <a href="/" class="text-blue-500 hover:underline text-sm sm:text-base">← Kembali ke Home</a>
            </div>
            <!-- Judul Beritas -->
            <h1 class="text-3xl sm:text-4xl font-semibold text-blue-600 mt-4 md:mt-6">
                {{ $beritas->judul }}
            </h1>
            <!-- Informasi Penulis dan Tanggal -->
            <p class="text-gray-500 text-sm sm:text-base mb-4">
                Penulis: {{ $beritas->penulis }} | Tanggal: {{ $beritas->created_at->format('d M Y') }}  |  Dilihat: {{ $beritas->views }} kali
            </p>

            <!-- Konten Beritas -->
            <div class="mt-6 text-gray-700 leading-relaxed text-sm sm:text-base">
                {!! nl2br(($beritas->konten)) !!}
            </div>

    </div>
@endsection
