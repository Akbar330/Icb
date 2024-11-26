@extends('layouts.admin')

@section('title', 'Tambah Oncam')

@section('content')
    <div class="px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-700">Tambah Link Oncam</h1>
        <p class="text-lg text-gray-500 mt-2">Tambahkan embed link Oncam baru ke dalam sistem.</p>

        <!-- Form Tambah Oncam -->
        <div class="bg-white p-6 rounded-lg shadow-md mt-6">
            <form action="{{ route('oncam.store') }}" method="POST">
                @csrf

                <!-- Embed Link -->
                <div class="mb-4">
                    <label for="embed_link" class="block text-gray-700 font-medium">Embed Link</label>
                    <input
                        type="url"
                        id="embed_link"
                        name="embed_link"
                        class="border px-4 py-2 rounded-lg w-full @error('embed_link') border-red-500 @enderror"
                        placeholder="Masukkan embed link (contoh: https://youtube.com/embed/...)"
                        value="{{ old('embed_link') }}"
                        required>
                    @error('embed_link')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tombol Simpan -->
                <div class="mt-6">
                    <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                        Simpan
                    </button>
                    <a href="{{ route('oncam.index') }}" class="ml-4 text-gray-600 hover:underline">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
