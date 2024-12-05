@extends('layouts.main')

@section('title', $berita->judul)

@section('content')
    <div class="container mx-auto px-4 py-12">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h1 class="text-4xl font-bold text-blue-600">{{ $berita->judul }}</h1>
            <p class="text-gray-500 text-sm mb-4">Penulis: {{ $berita->penulis }} | Tanggal: {{ $berita->created_at->format('d M Y') }}</p>

            {{-- @if ($berita->gambar)
                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" class="mt-4 w-full h-96 object-cover rounded-lg">
            @endif --}}

            <div class="mt-6 text-gray-700 leading-relaxed">
                {!! $artikels->konten !!}
            </div>
        </div>

        <div class="mt-8">
            <a href="{{ route('berita.index') }}" class="text-blue-500 hover:underline">← Kembali ke Daftar Berita</a>
        </div>
        <div class="mt-8">
            <a href="/" class="btn btn-primary">← Kembali ke Home</a>
        </div>
    </div>
@endsection
