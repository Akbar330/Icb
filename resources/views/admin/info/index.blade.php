@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-700">Dashboard Admin</h1>
        <p class="text-lg text-gray-500 mt-2">Kelola Artikel, Berita, dan Pengumuman di Sekolah Anda</p>

        <!-- Dashboard Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <!-- Tambah Informasi -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                <h2 class="text-xl font-semibold text-gray-700">Tambah Pengumuman</h2>
                <p class="text-gray-600 mt-2">Tambahkan pengumuman baru untuk berbagi informasi dengan warga sekolah.</p>
                <a href="{{ route('admin.info.create') }}" class="mt-4 inline-block bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 hover:bg-blue-700">
                    Tambah Pengumuman
                </a>
            </div>
        </div>

        <!-- Daftar Informasi -->
        <div class="mt-8">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Daftar Pengumuman</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Loop informasi dari database -->
                @foreach($informasis as $informasi)
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="flex items-center justify-center mb-4">
                            @if($informasi->gambar)
                                <img src="{{ asset('storage/' . $informasi->gambar) }}" alt="{{ $informasi->judul }}" class="w-full h-48 object-cover rounded-lg">
                            @else
                                <span class="text-gray-500">Tidak ada gambar</span>
                            @endif
                        </div>
                        <h3 class="text-xl font-semibold text-gray-700">{{ $informasi->judul }}</h3>
                        <p class="text-gray-600 mt-2">Penulis: {{ $informasi->penulis }}</p>
                        <p class="text-gray-500 mt-2">Tanggal: {{ \Carbon\Carbon::parse($informasi->tanggal)->format('d M Y') }}</p>
                        <div class="mt-4">
                            <a href="{{ route('admin.info.edit', $informasi->id) }}" class="text-blue-500 hover:underline">Edit</a> |
                            <form action="{{ route('admin.info.destroy', $informasi->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
