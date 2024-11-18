@extends('layouts.main')

@section('title', $artikels->judul)

@section('content')
    <div class="container mx-auto px-4 py-12">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h1 class="text-4xl font-bold text-blue-600">{{ $artikels->judul }}</h1>
            <p class="text-gray-500 text-sm mb-4">Penulis: {{ $artikels->penulis }} | Tanggal: {{ $artikels->created_at->format('d M Y') }}</p>

            @if ($artikels->gambar)
                <img src="{{ asset('storage/' . $artikels->gambar) }}" alt="Artikel Image" class="mt-4 w-full h-96 object-cover rounded-lg">
            @endif

            <div class="mt-6 text-gray-700 leading-relaxed">
                {{ $artikels->konten }}
            </div>
        </div>

        <div class="mt-8">
            <a href="{{ route('artikel.index') }}" class="btn btn-primary">← Kembali ke daftar artikel</a>
        </div>
    </div>
@endsection
