@extends('layouts.admin')

@section('title', 'Manajemen Banner Carousel')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Banner</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola gambar banner (carousel) yang tampil di halaman beranda.</p>
    </div>
    <a href="{{ route('admin.carousel.create') }}" class="inline-flex items-center bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-sm hover:bg-blue-700 hover:shadow-md transition-all">
        <i class="fas fa-plus mr-2"></i> Tambah Banner Baru
    </a>
</div>

<!-- Main Card -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <!-- Toolbar -->
    <div class="p-5 border-b border-gray-100 bg-gray-50/50">
        <h2 class="font-semibold text-gray-700">Daftar Banner</h2>
    </div>

    <div class="p-5 bg-gray-50/30">
        <!-- Carousel Grid -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($carousels as $carousel)
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md border border-gray-100 overflow-hidden flex flex-col transition-shadow duration-300 group">
                    <div class="relative aspect-[21/9] overflow-hidden bg-gray-100 flex items-center justify-center p-2">
                        @if($carousel->image_path)
                            <img src="{{ asset('storage/' . $carousel->image_path) }}" alt="Banner" class="w-full h-full object-contain transition duration-500 group-hover:scale-105">
                        @else
                            <div class="flex flex-col items-center justify-center text-gray-400">
                                <i class="fas fa-image text-4xl mb-2"></i>
                                <span class="text-sm">Tidak ada gambar</span>
                            </div>
                        @endif
                        <div class="absolute top-2 right-2 bg-blue-600/90 backdrop-blur text-white text-xs font-bold px-2 py-1 rounded shadow-sm">
                            Urutan: {{ $carousel->order ?? '-' }}
                        </div>
                    </div>
                    
                    <div class="p-4 flex flex-col mt-auto pt-4 border-t border-gray-50 bg-white">
                        <div class="flex justify-between items-center gap-2">
                            <a href="{{ route('admin.carousel.edit', $carousel->id) }}" class="flex-1 text-center bg-blue-50 hover:bg-blue-100 text-blue-600 font-medium py-1.5 px-3 rounded-lg text-sm transition-colors">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                            <form action="{{ route('admin.carousel.destroy', $carousel->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus banner ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full text-center bg-red-50 hover:bg-red-100 text-red-600 font-medium py-1.5 px-3 rounded-lg text-sm transition-colors">
                                    <i class="fas fa-trash-alt mr-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white p-8 rounded-xl border border-dashed border-gray-300 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                        <i class="fas fa-images text-2xl text-gray-400"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">Belum ada banner</h3>
                    <p class="text-gray-500">Mulai tambahkan banner untuk mempercantik beranda website.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
