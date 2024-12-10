@extends('layouts.admin')

@section('title', 'Tambah Biaya Sekolah')

@section('content')
    <div class="px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-700">Tambah Biaya Sekolah</h1>

        <form action="{{ route('admin.biaya.store') }}" method="POST" class="mt-6">
            @csrf

            <div class="mb-4">
                <label for="nama_biaya" class="block text-gray-700 font-semibold">Nama Biaya</label>
                <input type="text" id="nama_biaya" name="nama_biaya" class="w-full p-2 border border-gray-300 rounded mt-1"
                    required>
                @error('nama_biaya')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="jumlah" class="block text-gray-700 font-semibold">SPP</label>
                <input type="number" id="jumlah" name="jumlah" class="w-full p-2 border border-gray-300 rounded mt-1"
                    required>
                @error('jumlah')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="jumlah_non" class="block text-gray-700 font-semibold">Non-SPP</label>
                <input type="number" id="jumlah_non" name="jumlah_non"
                    class="w-full p-2 border border-gray-300 rounded mt-1" required>
                @error('jumlah_non')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="keterangan" class="block text-gray-700 font-semibold">Keterangan</label>
                <input type="text" id="keterangan" name="keterangan"
                    class="w-full p-2 border border-gray-300 rounded mt-1">
                @error('keterangan')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 hover:bg-blue-700">
                Tambah Biaya
            </button>
        </form>
    </div>
@endsection
