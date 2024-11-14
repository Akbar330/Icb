@extends('layouts.admin')

@section('title', 'Upload Gambar')

@section('content')
    <div class="px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-700">Upload Gambar</h1>
        <p class="text-lg text-gray-500 mt-2">Unggah gambar baru untuk galeri Anda.</p>

        <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" class="mt-6">
            @csrf

            <!-- Gambar -->
            <div class="mb-4">
                <label for="gambar" class="block text-gray-700 font-semibold">Pilih Gambar</label>
                <input type="file" id="gambar" name="gambar"
                       class="w-full p-2 border border-gray-300 rounded mt-1" accept="image/*" required>
                @error('gambar')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tombol Unggah -->
            <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 hover:bg-blue-700">
                Unggah Gambar
            </button>
        </form>
    </div>
@endsection
