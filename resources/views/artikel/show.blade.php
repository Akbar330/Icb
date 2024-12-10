@extends('layouts.main')

@section('title', $artikels->judul)

@section('content')

    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Card Artikel -->
        <div class="bg-white rounded-lg shadow-lg p-5 md:p-8">
            <div class="mt-8">
                <a href="{{ route('artikel.index') }}" 
                   class="text-primary text-sm sm:text-base">
                    ← Kembali ke daftar artikel
                </a>
            </div>
            <!-- Judul Artikel -->
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-blue-600">
                {{ $artikels->judul }}
            </h1>
            <!-- Informasi Penulis dan Tanggal -->
            <p class="text-gray-500 text-sm sm:text-base mb-4">
                Penulis: {{ $artikels->penulis }} | Tanggal: {{ $artikels->created_at->format('d M Y') }}
            </p>

            <!-- Konten Artikel -->
            <div class="mt-6 text-gray-700 leading-relaxed text-sm sm:text-base">
                {!! $artikels->konten !!}
            </div>
        </div>

        <!-- Tombol Kembali -->

    </div>
@endsection
