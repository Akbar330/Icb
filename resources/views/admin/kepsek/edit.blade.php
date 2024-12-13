@extends('layouts.admin')

@section('title', 'Edit Tulisan Kepsek')

@section('content')
    <div class="px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-700">Edit Kepsek</h1>
        <p class="text-lg text-gray-500 mt-2">Ubah Kepsek atau pengumuman yang ada.</p>

        <!-- Form Edit Kepsek -->
        <form action="{{ route('admin.kepsek.update', $kepsek->id) }}" method="POST" enctype="multipart/form-data" class="mt-6">
            @csrf
            @method('PUT')

            <!-- nama -->
            <div class="mb-4">
                <label for="nama" class="block text-gray-700 font-semibold">Nama Kepsek</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $kepsek->nama) }}"
                       class="w-full p-2 border border-gray-300 rounded mt-1" required>
                @error('nama')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Konten -->
            <div class="mb-4">
                <label for="konten" class="block text-gray-700 font-semibold">Konten</label>
                <textarea name="konten" id="konten" rows="5"
                          class="w-full p-2 border border-gray-300 rounded mt-1" required>{{ old('konten', $kepsek->konten) }}</textarea>
                @error('konten')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Gambar (Opsional) -->
            <div class="mb-4">
                <label for="gambar" class="block text-gray-700 font-semibold">Gambar (Opsional)</label>
                <input type="file" name="gambar" id="gambar" class="w-full p-2 border border-gray-300 rounded mt-1">
                @if($kepsek->gambar)
                    <img src="{{ asset('storage/' . $kepsek->gambar) }}" alt="{{ $kepsek->judul }}" class="mt-4 w-32 h-32 object-cover rounded">
                @endif
                @error('gambar')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tombol Simpan -->
            <div class="mt-6">
                <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 transition duration-300">
                    Update Kepsek
                </button>
                <a href="{{ route('admin.kepsek.index') }}" class="ml-4 text-gray-600 hover:underline">Batal</a>
            </div>
        </form>

        <!-- Form Hapus Kepsek -->
        <form action="{{ route('admin.kepsek.destroy', $kepsek->id) }}" method="POST" class="mt-6">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus Tulisan Kepsek ini?')"
                    class="bg-red-600 text-white font-semibold py-2 px-4 rounded hover:bg-red-700 transition duration-300">
                Hapus Tulisan Kepsek
            </button>
        </form>
    </div>
@endsection
