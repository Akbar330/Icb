@extends('layouts.admin')

@section('title', 'Dashboard Kepsek')

@section('content')
<div class="px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-700">Dashboard Kepsek</h1>

    <!-- Tambah Tulisan Kepsek & Gambar -->
    <div class="mt-6">
        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
            <h2 class="text-xl font-semibold text-gray-700">Tambah Tulisan Kepsek & Gambar</h2>
            <a href="{{ route('admin.kepsek.create') }}"
               class="mt-4 inline-block bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                Tambah Tulisan Kepsek
            </a>
        </div>
    </div>

    <!-- Daftar Tulisan Kepsek & Gambar -->
    <div class="mt-8">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Daftar Tulisan Kepsek & Gambar</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($kepsek as $keps)
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center justify-center mb-4">
                        @if($keps->gambar)
                            <img src="{{ asset('storage/' . $keps->gambar) }}"
                                 alt="{{ $keps->konten }}"
                                 class="w-full h-48 object-cover rounded-lg">
                        @else
                            <span class="text-gray-500">Tidak ada gambar</span>
                        @endif
                    </div>
                    <div class="mt-4">
                        <h3 class="text-xl font-semibold text-gray-700">{{ $keps->nama }}</h3>

                        <div class="flex justify-between mt-4">
                            <a href="{{ route('admin.kepsek.edit', $keps->id) }}"
                               class="text-blue-500 hover:underline">
                                Edit
                            </a>
                            <form action="{{ route('admin.kepsek.destroy', $keps->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
