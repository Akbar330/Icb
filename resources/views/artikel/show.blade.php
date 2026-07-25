@extends('layouts.main')

@section('title', $artikels->judul)

@section('content')
<div class="w-full">
    <!-- Breadcrumb / Back Button -->
    <div class="mb-6 px-2">
        <a href="javascript:history.back()" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors bg-blue-50 px-4 py-2 rounded-lg">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <article class="w-full">
        @if(isset($artikels->gambar) && $artikels->gambar)
            <!-- Featured Image (No cropping) -->
            <div class="w-full mb-8 flex justify-center bg-gray-100 rounded-xl overflow-hidden shadow-sm">
                <img src="{{ asset('storage/' . $artikels->gambar) }}" alt="{{ $artikels->judul }}" class="w-full h-auto max-h-[500px] object-contain">
            </div>
        @else
            <!-- Gradient Header fallback if no image -->
            <div class="w-full h-32 md:h-48 bg-gradient-to-r from-blue-700 to-blue-900 relative rounded-xl overflow-hidden mb-8">
                <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
            </div>
        @endif

        <div class="px-2 md:px-8">
            <!-- Meta Info -->
            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 mb-6 border-b border-gray-200 pb-4">
                <span class="flex items-center bg-blue-50 text-blue-700 px-3 py-1 rounded-full font-medium">
                    <i class="far fa-user mr-2"></i> {{ $artikels->penulis ?? 'Admin' }}
                </span>
                <span class="flex items-center">
                    <i class="far fa-calendar-alt mr-2 text-gray-400"></i> {{ \Carbon\Carbon::parse($artikels->created_at)->translatedFormat('d F Y') }}
                </span>
                <span class="flex items-center">
                    <i class="far fa-eye mr-2 text-gray-400"></i> {{ $artikels->views ?? 0 }} kali dilihat
                </span>
            </div>

            <!-- Title -->
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gray-900 mb-8 leading-tight tracking-tight">
                {{ $artikels->judul }}
            </h1>

            <!-- Content -->
            <div class="prose prose-lg prose-blue max-w-none text-gray-700 leading-relaxed text-justify">
                {!! nl2br($artikels->konten) !!}
            </div>
        </div>
        
        <!-- Share / Footer section -->
        <div class="mt-12 pt-6 px-2 md:px-8 border-t border-gray-200 flex flex-col sm:flex-row justify-between items-center gap-4">
            <p class="text-sm text-gray-500 font-medium">Bagikan artikel ini:</p>
            <div class="flex gap-2">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}" target="_blank" class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition-colors shadow-sm">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::fullUrl()) }}&text={{ urlencode($artikels->judul) }}" target="_blank" class="w-10 h-10 rounded-full bg-blue-400 text-white flex items-center justify-center hover:bg-blue-500 transition-colors shadow-sm">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="https://api.whatsapp.com/send?text={{ urlencode($artikels->judul . ' - ' . Request::fullUrl()) }}" target="_blank" class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center hover:bg-green-600 transition-colors shadow-sm">
                    <i class="fab fa-whatsapp text-lg"></i>
                </a>
            </div>
        </div>
    </article>
</div>
@endsection
