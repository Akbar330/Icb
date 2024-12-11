@extends('layouts.main')

@section('title', $artikels->judul)

@section('content')

    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mt-4 md:mt-8">
                <a href="/" 
                   class="text-primary text-sm sm:text-base">
                    ← Kembali ke Home
                </a>
            </div>
            <!-- Judul Artikel -->
            <h1 class="text-xl sm:text-2xl md:text-3xl font-semibold text-blue-600 mt-4 md:mt-6">
                {{ $artikels->judul }}
            </h1>
            <!-- Informasi Penulis dan Tanggal -->
            <p class="text-gray-500 text-sm sm:text-base mb-4">
                Penulis: {{ $artikels->penulis }} | Tanggal: {{ $artikels->created_at->format('d M Y') }}
            </p>

            <!-- Konten Artikel -->
            <div class="mt-6 text-gray-700 leading-relaxed text-sm sm:text-base">
                <!-- Gunakan paragraf, heading, dan list untuk membuat artikel lebih terstruktur -->
                {!! nl2br(e($artikels->konten)) !!}
            </div>
        </div>

        <!-- Tombol Kembali -->
    </div>
    
@endsection
