@extends('layouts.admin')

@section('title', 'Galeri Gambar')

@section('content')
    <div class="px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-700">Galeri Gambar</h1>
        <p class="text-lg text-gray-500 mt-2">Berikut adalah gambar-gambar yang telah diunggah ke galeri.</p>

        <!-- Tombol untuk menambah gambar -->
        <a href="{{ route('admin.galeri.create') }}" 
           class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 hover:bg-blue-700 mt-6 inline-block">
            Upload Gambar Baru
        </a>

        <!-- Responsive Grid -->
        <div class="mt-8 grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach($gambarGaleri as $gambar)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <!-- Menampilkan gambar dengan ukuran proporsional -->
                        <img src="{{ asset('storage/'.$gambar->filename) }}" 
                             alt="Gambar Galeri" 
                            >
                </div>
            @endforeach
        </div>
    </div>
@endsection
