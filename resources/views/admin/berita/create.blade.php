@extends('layouts.admin')

@section('title', 'Tambah Berita')

@section('content')
    <div class="px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-700">Berita</h1>

        <form action="{{ route('admin.berita.store') }}" method="POST" class="mt-6">
            @csrf
            <div class="mb-4">
                <label for="judul" class="block text-gray-700">Judul:</label>
                <input type="text" id="judul" name="judul" class="w-full p-2 border border-gray-300 rounded">
            </div>

            <div class="mb-4">
                <label for="penulis" class="block text-gray-700">Penulis:</label>
                <input type="text" id="penulis" name="penulis" class="w-full p-2 border border-gray-300 rounded">
            </div>

            <div class="mb-4">
                <label for="konten" class="block text-gray-700">Konten:</label>
                <textarea id="konten" name="konten" class="w-full p-2 border border-gray-300 rounded"></textarea>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Berita</button>
        </form>
    </div>
@endsection
