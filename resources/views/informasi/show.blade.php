@extends('layouts.main')

@section('title', $informasi->judul)

@section('content')
<div class="w-full">
    <!-- Breadcrumb / Back Button -->
    <div class="mb-6 px-2">
        <a href="javascript:history.back()" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <!-- Header Informasi -->
    <header class="mb-8 px-2">
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 leading-tight mb-4 tracking-tight">
            {{ $informasi->judul }}
        </h1>
        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 font-medium">
            <div class="flex items-center">
                <i class="fas fa-bullhorn mr-2 text-blue-500"></i> Pengumuman / Informasi
            </div>
            @if($informasi->created_at)
            <div class="flex items-center">
                <i class="far fa-calendar-alt mr-2 text-blue-500"></i>
                {{ $informasi->created_at->format('d M Y') }}
            </div>
            @endif
        </div>
    </header>

    <article class="w-full">
        @if(isset($informasi->gambar) && $informasi->gambar)
            <!-- Featured Image (No cropping) -->
            <div class="w-full mb-8 flex justify-center bg-gray-100 rounded-xl overflow-hidden shadow-sm">
                <img src="{{ asset('storage/' . $informasi->gambar) }}" 
                     alt="{{ $informasi->judul }}" 
                     class="w-full h-auto max-h-[500px] object-contain">
            </div>
        @endif

        <!-- Konten Informasi -->
        <div class="prose prose-lg prose-blue max-w-none text-gray-700 leading-relaxed text-sm sm:text-base">
            {!! nl2br(($informasi->konten)) !!}
        </div>
    </article>

    <!-- Tombol Share (Optional tapi menambah kesan elegan) -->
    <div class="mt-12 pt-6 border-t border-gray-100 px-2 flex items-center justify-between">
        <div class="text-sm font-semibold text-gray-900 uppercase tracking-wider">Bagikan Informasi</div>
        <div class="flex gap-3">
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-blue-600 hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ urlencode($informasi->judul) }}" target="_blank" class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-blue-400 hover:bg-blue-400 hover:text-white transition-all shadow-sm">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="https://api.whatsapp.com/send?text={{ urlencode($informasi->judul . ' ' . url()->current()) }}" target="_blank" class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-green-500 hover:bg-green-500 hover:text-white transition-all shadow-sm">
                <i class="fab fa-whatsapp text-lg"></i>
            </a>
        </div>
    </div>
</div>
@endsection
