@extends('layouts.main')

@section('title', 'Berita')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold text-blue-600 text-center">Berita Sekolah</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
            @foreach ($beritas as $berita)
                <a href="{{ route('berita.show', $berita->id) }}" class="bg-white rounded-lg shadow-lg p-6 block hover:bg-gray-100 transition duration-200">
                    <h3 class="text-2xl font-semibold text-blue-600">{{ $berita->judul }}</h3>
                    <p class="text-gray-600">{{ Str::limit($berita->konten, 150) }}</p>
                    <p class="text-gray-500 text-sm">Penulis: {{ $berita->penulis }}</p>
                    @if ($berita->gambar)
                        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" class="mt-4 w-full h-48 object-cover rounded-lg">
                    @endif
                </a>
            @endforeach
        </div>
    </div>
@endsection
