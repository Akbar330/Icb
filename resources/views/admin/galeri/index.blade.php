@extends('layouts.admin')

@section('title', 'Galeri Gambar')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Galeri Gambar</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola dan unggah foto-foto kegiatan sekolah.</p>
    </div>
    <a href="{{ route('admin.galeri.create') }}" class="inline-flex items-center bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-sm hover:bg-blue-700 hover:shadow-md transition-all">
        <i class="fas fa-upload mr-2"></i> Upload Gambar Baru
    </a>
</div>

<!-- Main Card -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <!-- Toolbar -->
    <div class="p-5 border-b border-gray-100 bg-gray-50/50">
        <h2 class="font-semibold text-gray-700">Daftar Foto Galeri</h2>
    </div>

    <div class="p-5 bg-gray-50/30">
        <!-- Galeri Grid -->
        <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @forelse($gambarGaleri as $gambar)
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md border border-gray-100 overflow-hidden group">
                    <div class="relative aspect-video sm:aspect-square md:aspect-[4/3] overflow-hidden bg-gray-100 flex items-center justify-center p-2">
                        <img src="{{ asset('storage/'.$gambar->filename) }}" alt="Gambar Galeri" class="w-full h-full object-contain transition duration-500 group-hover:scale-105">
                        
                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <a href="{{ asset('storage/'.$gambar->filename) }}" target="_blank" class="bg-white/90 text-gray-800 hover:bg-white px-3 py-1.5 rounded-lg text-sm font-medium shadow-sm transition-colors">
                                <i class="fas fa-search-plus mr-1"></i> Lihat
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white p-8 rounded-xl border border-dashed border-gray-300 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                        <i class="fas fa-images text-2xl text-gray-400"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">Galeri Masih Kosong</h3>
                    <p class="text-gray-500">Silakan upload gambar pertama Anda untuk ditampilkan di galeri web.</p>
                </div>
            @endforelse
        </div>
        
    </div>
</div>
@endsection
