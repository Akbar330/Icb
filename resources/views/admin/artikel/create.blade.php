@extends('layouts.admin')

@section('title', 'Tambah Artikel')

@section('content')
    <div class="px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-700">Tambah Artikel</h1>

        <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data" class="mt-6">
            @csrf
            <div class="mb-4">
                <label for="judul" class="block text-gray-700">Judul:</label>
                <input type="text" id="judul" name="judul" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label for="penulis" class="block text-gray-700">Penulis:</label>
                <input type="text" id="penulis" name="penulis" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label for="konten" class="block text-gray-700">Konten:</label>
                <textarea id="konten" name="konten" class="w-full p-2 border border-gray-300 rounded" required></textarea>
            </div>

            <div class="mb-4">
                <label for="gambar" class="block text-gray-700">Gambar:</label>
                <input type="file" id="gambar" name="gambar" class="w-full p-2 border border-gray-300 rounded" accept="image/*">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Artikel</button>
        </form>
    </div>
@endsection
