@extends('layouts.admin')

@section('title', 'Edit Artikel')

@section('content')
    <div class="px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-700">Edit Artikel</h1>
        <p class="text-lg text-gray-500 mt-2">Ubah artikel yang sudah ada</p>

        <!-- Form Edit Artikel -->
        <div class="bg-white p-6 rounded-lg shadow-md mt-6">
            <form action="{{ route('admin.artikel.update', $artikel->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Judul Artikel -->
                <div class="mb-4">
                    <label for="judul" class="block text-gray-700 font-semibold">Judul Artikel</label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul', $artikel->judul) }}"
                           class="w-full mt-2 p-2 border border-gray-300 rounded-md" required>
                    @error('judul')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Penulis Artikel -->
                <div class="mb-4">
                    <label for="penulis" class="block text-gray-700 font-semibold">Penulis</label>
                    <input type="text" id="penulis" name="penulis" value="{{ old('penulis', $artikel->penulis) }}"
                           class="w-full mt-2 p-2 border border-gray-300 rounded-md" required>
                    @error('penulis')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Konten Artikel -->
                <div class="mb-4">
                    <label for="konten" class="block text-gray-700 font-semibold">Konten Artikel</label>
                    <textarea id="konten" name="konten" rows="6"
                              class="w-full mt-2 p-2 border border-gray-300 rounded-md" required>{{ old('konten', $artikel->konten) }}</textarea>
                    @error('konten')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tombol Simpan -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white py-2 px-6 rounded-md hover:bg-blue-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
