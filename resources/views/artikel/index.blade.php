@extends('layouts.main')

@section('title', 'Artikel')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold text-blue-600 text-center">Artikel Terbaru</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
            @foreach ($artikels as $artikel)
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-2xl font-semibold text-blue-600">{{ $artikel->judul }}</h3>
                    <p class="text-gray-600">{{ Str::limit($artikel->konten, 150) }}</p>
                    <p class="text-gray-500 text-sm">Penulis: {{ $artikel->penulis }}</p>
                    @if ($artikel->gambar)
                        <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="Artikel Image" class="mt-4 w-full h-48 object-cover rounded-lg">
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
