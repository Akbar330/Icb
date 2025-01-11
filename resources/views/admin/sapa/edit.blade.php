@extends('layouts.admin')

@section('title', 'Edit Sapaan')

@section('content')
    <div class="px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-700">Edit Sapaan</h1>
        <form action="{{ route('admin.sapa.update', $sapaan->id) }}" method="POST" enctype="multipart/form-data" class="mt-6">
            @csrf
            @method('PUT')

            <!-- Sapaan Artikel -->
            <div class="mb-4">
                <label for="sapaan" class="block text-gray-700 font-semibold">Sapaan</label>
                <input type="text" id="sapaan" name="sapaan" value="{{ old('sapaan', $sapaan->sapaan) }}"
                       class="w-full p-2 border border-gray-300 rounded mt-1" required>

                @error('sapaan')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Gambar Saat Ini -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold">Gambar Saat Ini</label>
                @if (!empty($sapaan->gambar) && file_exists(public_path('storage/' . $sapaan->gambar)))
                    <img src="{{ asset('storage/' . $sapaan->gambar) }}" alt="Gambar Sapaan"
                         class="w-32 h-32 object-cover border border-gray-300 rounded mt-2">
                @else
                    <p class="text-gray-500 mt-2">Tidak ada gambar saat ini.</p>
                @endif
            </div>

            <!-- Unggah Gambar Baru -->
            <div class="mb-4">
                <label for="gambar" class="block text-gray-700 font-semibold">Gambar Baru</label>
                <input type="file" id="gambar" name="gambar" accept="image/*"
                       class="w-full p-2 border border-gray-300 rounded mt-1">

                @error('gambar')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tombol Simpan -->
            <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 hover:bg-blue-700">
                Simpan Sapaan
            </button>
        </form>
    </div>
@endsection
