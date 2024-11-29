@extends('layouts.admin')

@section('title', 'Upload Gambar')

@section('content')
    <div class="px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-700 mb-6">Upload Gambar</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="gambar" class="block text-gray-700 font-bold mb-2">Pilih Gambar</label>
                <input type="file" name="gambar" id="gambar" class="w-full border-gray-300 rounded-lg shadow-sm">
                @error('gambar')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">
                Upload
            </button>
        </form>
    </div>
@endsection
