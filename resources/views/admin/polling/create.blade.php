@extends('layouts.admin')

@section('title', 'Tambah Polling')

@section('content')
    <div class="px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-700">Tambah Polling</h1>
        <form action="{{ route('admin.polling.store') }}" method="POST" class="mt-6">
            @csrf

            <!-- sapaan Artikel -->

            <div class="mb-4">
                <label for="nama_polling" class="block text-gray-700 font-semibold">Nama Polling</label>
                <input type="text" id="nama_polling" name="nama_polling" value="{{ old('nama_polling') }}"
                       class="w-full p-2 border border-gray-300 rounded mt-1" required>
                @error('nama_polling')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="option_1" class="block text-gray-700 font-semibold">Pilihan 1</label>
                <input type="text" id="option_1" name="option_1" value="{{ old('option_1') }}"
                       class="w-full p-2 border border-gray-300 rounded mt-1" required>
                @error('option_1')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="option_2" class="block text-gray-700 font-semibold">Pilihan 2</label>
                <input type="text" id="option_2" name="option_2" value="{{ old('option_2') }}"
                       class="w-full p-2 border border-gray-300 rounded mt-1" required>
                @error('option_2')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="option_3" class="block text-gray-700 font-semibold">Pilihan 3</label>
                <input type="text" id="option_3" name="option_3" value="{{ old('option_3') }}"
                       class="w-full p-2 border border-gray-300 rounded mt-1" required>
                @error('option_3')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="isShow" class="block text-gray-700 font-semibold">Tampilkan Di Beranda?</label>
                <select id="isShow" name="isShow" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                    <option value="" disabled selected>Pilih Opsi</option>
                    <option value="1" {{ old('isShow') == 'tampilkan' ? 'selected' : '' }}>Ya</option>
                    <option value="0" {{ old('isShow') == 'tidak_tampilkan' ? 'selected' : '' }}>Tidak</option>
                </select>
                @error('isShow')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <!-- Tombol Simpan -->
            <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 hover:bg-blue-700">
                Simpan Polling
            </button>
        </form>
    </div>
@endsection
