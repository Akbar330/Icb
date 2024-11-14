@extends('layouts.main')

@section('title', 'Galeri')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold text-blue-600 text-center">Galeri Sekolah</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
            @foreach($gambarGaleri as $gambar)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <!-- Menampilkan gambar dari database -->
                    <img src="{{ asset('storage/'.$gambar->filename) }}" alt="Gallery Image" class="w-full h-64 object-cover">
                </div>
            @endforeach
        </div>
    </div>
@endsection
