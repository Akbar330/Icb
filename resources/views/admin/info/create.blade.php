@extends('layouts.admin')

@section('title', 'Tambah Informasi')

@section('content')
    <div class="px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-700">Tambah Informasi</h1>
        <p class="text-lg text-gray-500 mt-2">Tambahkan informasi atau pengumuman baru untuk pengunjung situs.</p>

        <form action="{{ route('admin.info.store') }}" method="POST" enctype="multipart/form-data" class="mt-6">
            @csrf

            <!-- Judul -->
            <div class="mb-4">
                <label for="judul" class="block text-gray-700 font-semibold">Judul Informasi</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
                       class="w-full p-2 border border-gray-300 rounded mt-1" required>
                @error('judul')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Konten -->
            <div class="mb-4">
                <label for="konten" class="block text-gray-700 font-semibold">Konten</label>
                <textarea name="konten" id="konten" rows="5"
                          class="w-full p-2 border border-gray-300 rounded mt-1" required>{{ old('konten') }}</textarea>
                @error('konten')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Penulis -->
            <div class="mb-4">
                <label for="penulis" class="block text-gray-700 font-semibold">Penulis</label>
                <input type="text" name="penulis" id="penulis" value="{{ old('penulis') }}"
                       class="w-full p-2 border border-gray-300 rounded mt-1" required>
                @error('penulis')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tanggal -->
            <div class="mb-4">
                <label for="tanggal" class="block text-gray-700 font-semibold">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal') }}"
                       class="w-full p-2 border border-gray-300 rounded mt-1" required>
                @error('tanggal')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Gambar (Opsional) -->
            <div class="mb-4">
                <label for="gambar" class="block text-gray-700 font-semibold">Gambar (Opsional)</label>
                <input type="file" name="gambar" id="gambar" class="w-full p-2 border border-gray-300 rounded mt-1">
                @error('gambar')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tombol Simpan -->
            <div class="mt-6">
                <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 transition duration-300">
                    Simpan Informasi
                </button>
                <a href="{{ route('admin.info.index') }}" class="ml-4 text-gray-600 hover:underline">Batal</a>
            </div>
        </form>
    </div>
@endsection
