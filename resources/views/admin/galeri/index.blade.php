@extends('layouts.admin')

@section('title', 'Galeri Gambar')

@section('content')
    <div class="px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-700">Galeri Gambar</h1>
        <p class="text-lg text-gray-500 mt-2">Berikut adalah gambar-gambar yang telah diunggah ke galeri.</p>

        <!-- Tombol untuk menambah gambar -->
        <a href="{{ route('admin.galeri.create') }}" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 hover:bg-blue-700 mt-6 inline-block">
            Upload Gambar Baru
        </a>

        <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($gambarGaleri as $gambar)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <!-- Menampilkan gambar tanpa path -->
                    <img src="{{ asset('storage/'.$gambar->filename) }}" alt="Gambar Galeri" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <!-- Menghapus tampilan nama file -->
                        <!-- <p class="text-gray-700 text-sm">{{ $gambar->filename }}</p> -->
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
