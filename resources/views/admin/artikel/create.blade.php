@extends('layouts.admin')

@section('title', 'Tambah Artikel')

@section('content')
    <div class="px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-700">Tambah Artikel</h1>
        <p class="text-lg text-gray-500 mt-2">Buat artikel baru untuk berbagi informasi penting dengan pengunjung.</p>

        <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data" class="mt-6">
            @csrf

            <!-- Judul Artikel -->
            <div class="mb-4">
                <label for="judul" class="block text-gray-700 font-semibold">Judul Artikel</label>
                <input type="text" id="judul" name="judul" value="{{ old('judul') }}"
                       class="w-full p-2 border border-gray-300 rounded mt-1" required>
                @error('judul')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Penulis Artikel -->
            <div class="mb-4">
                <label for="penulis" class="block text-gray-700 font-semibold">Penulis</label>
                <input type="text" id="penulis" name="penulis" value="{{ old('penulis') }}"
                       class="w-full p-2 border border-gray-300 rounded mt-1" required>
                @error('penulis')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Konten Artikel -->
            <div class="mb-4">
                <label for="konten" class="block text-gray-700 font-semibold">Konten</label>
                <textarea id="konten" name="konten" rows="6"
                          class="w-full p-2 border border-gray-300 rounded mt-1" required>{{ old('konten') }}</textarea>
                @error('konten')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Gambar Artikel -->
            <div class="mb-4">
                <label for="gambar" class="block text-gray-700 font-semibold">Gambar</label>
                <input type="file" id="gambar" name="gambar"
                       class="w-full p-2 border border-gray-300 rounded mt-1" accept="image/*">
                @error('gambar')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tombol Simpan -->
            <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 hover:bg-blue-700">
                Simpan Artikel
            </button>
        </form>
    </div>
@endsection
