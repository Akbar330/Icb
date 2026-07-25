@extends('layouts.main')

@section('title', 'Galeri')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <div class="text-center mb-10">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800">Galeri Sekolah</h1>
            <div class="w-20 h-1.5 bg-blue-600 mx-auto mt-4 rounded-full"></div>
            <p class="text-gray-500 mt-4 text-lg">Momen dan dokumentasi kegiatan di lingkungan sekolah.</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
            @forelse($gambarGaleri as $gambar)
                <div class="bg-white rounded-xl shadow-sm hover-card overflow-hidden group border border-gray-100">
                    <div class="relative h-48 md:h-64 bg-gray-100 flex items-center justify-center">
                        <img src="{{ asset('storage/'.$gambar->filename) }}" alt="Gallery Image" class="w-full h-full object-contain p-2 transition duration-500 group-hover:scale-110" loading="lazy">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition duration-300 flex items-center justify-center pointer-events-none">
                            <i class="fas fa-search-plus text-white opacity-0 group-hover:opacity-100 text-3xl transform scale-50 group-hover:scale-100 transition duration-300"></i>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 bg-gray-50 rounded-xl border border-dashed border-gray-300">
                    <p class="text-gray-500 italic">Belum ada foto di galeri.</p>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-12">
            {{ $gambarGaleri->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
 