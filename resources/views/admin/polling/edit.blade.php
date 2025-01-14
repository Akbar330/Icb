@extends('layouts.admin')

@section('title', 'Edit Polling')

@section('content')
    <div class="px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-700">Edit Polling</h1>
        <form action="{{ route('admin.polling.update',$polling->id) }}" method="POST" class="mt-6">
            @csrf
            @method('PUT')
            <!-- sapaan Artikel -->

            <div class="mb-4">
                <label for="nama_polling" class="block text-gray-700 font-semibold">Nama Polling</label>
                <input type="text" id="nama_polling" name="nama_polling"
                    value="{{ old('nama_polling', $polling->nama_polling) }}"
                    class="w-full p-2 border border-gray-300 rounded mt-1" required>
                @error('nama_polling')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            @foreach ($pilihans as $pilihan)
                <div class="mb-4">
                    <label for="option_{{ $loop->index + 1 }}" class="block text-gray-700 font-semibold">
                        Pilihan {{ $loop->index + 1 }}
                    </label>
                    <input type="text" id="option_{{ $loop->index + 1 }}" name="option_{{ $loop->index + 1 }}"
                        value="{{ old('option_' . ($loop->index + 1), $pilihan->option ?? '') }}"
                        class="w-full p-2 border border-gray-300 rounded mt-1" required>
                    @error('option_{{ $loop->index + 1 }}')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            @endforeach

            <div class="mb-4">
                <label for="isShow" class="block text-gray-700 font-semibold">Tampilkan Di Beranda?</label>
                <select id="isShow" name="isShow" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                    <option value="" disabled selected>Pilih Opsi</option>
                    <option value="1" {{ old('isShow', $polling->isShowing) == 1 ? 'selected' : '' }}>Ya</option>
                    <option value="0" {{ old('isShow', $polling->isShowing) == 0 ? 'selected' : '' }}>Tidak
                    </option>
                </select>
                @error('isShow')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <!-- Tombol Simpan -->
            <button type="submit"
                class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 hover:bg-blue-700">
                Simpan Polling
            </button>
        </form>
    </div>
@endsection
