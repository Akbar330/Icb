@extends('layouts.main')

@section('title', 'Hasil Pencarian - ' . $query)

@section('content')
<div class="container mx-auto px-4 py-8 max-w-7xl">
    <div class="flex flex-col lg:flex-row gap-8">
        
        <!-- Left Section: Hasil Pencarian (70%) -->
        <div class="w-full lg:w-2/3">
            <div class="mb-8 border-b border-gray-200 pb-4">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Hasil Pencarian</h1>
                <p class="text-gray-500">
                    Menampilkan hasil artikel untuk kata kunci: <span class="font-semibold text-blue-600">"{{ $query }}"</span>
                </p>
            </div>

            <div class="space-y-6">
                @if ($artikels->isEmpty())
                    <div class="bg-gray-50 border border-gray-200 rounded-xl p-10 text-center">
                        <i class="fas fa-search text-5xl text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Tidak Ditemukan</h3>
                        <p class="text-gray-500">Maaf, kami tidak menemukan artikel yang cocok dengan kata kunci "{{ $query }}". Silakan coba dengan kata kunci lain.</p>
                    </div>
                @else
                    @foreach ($artikels as $artikel)
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-md border border-gray-100 overflow-hidden transition-all duration-300 flex flex-col sm:flex-row group">
                            @if ($artikel->gambar)
                                <div class="w-full sm:w-1/3 h-48 sm:h-auto relative overflow-hidden bg-gray-100 flex-shrink-0">
                                    <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="{{ $artikel->judul }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent sm:hidden"></div>
                                </div>
                            @endif
                            
                            <div class="p-6 flex flex-col flex-1">
                                <div class="flex items-center text-xs text-gray-500 mb-2 space-x-3">
                                    <span class="flex items-center"><i class="far fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($artikel->created_at)->format('d M Y') }}</span>
                                    <span class="flex items-center"><i class="far fa-user mr-1"></i> {{ $artikel->penulis ?? 'Admin' }}</span>
                                </div>
                                
                                <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-blue-600 transition-colors line-clamp-2">
                                    <a href="{{ route('artikel.show', $artikel->id) }}" class="focus:outline-none">
                                        {{ $artikel->judul }}
                                    </a>
                                </h3>
                                
                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($artikel->konten), 150) }}
                                </p>
                                
                                <div class="mt-auto">
                                    <a href="{{ route('artikel.show', $artikel->id) }}" class="inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-800 transition-colors">
                                        Baca Selengkapnya <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Right Section: Sidebar (30%) -->
        <div class="w-full lg:w-1/3 space-y-6 mt-8 lg:mt-0">
            
            <!-- Form Pencarian -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h5 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-search text-blue-500 mr-2"></i> Cari Artikel Lain
                </h5>
                <form action="{{ route('artikel.search') }}" method="GET">
                    <div class="relative">
                        <input type="text" name="query" value="{{ $query }}" class="w-full bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block pl-4 pr-12 py-3 transition-colors" placeholder="Ketik kata kunci..." required>
                        <button type="submit" class="absolute inset-y-0 right-0 flex items-center px-4 text-gray-500 hover:text-blue-600 bg-transparent border-l border-gray-200 focus:outline-none">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Kontak Sekolah -->
            <div class="bg-gradient-to-br from-blue-900 to-blue-800 rounded-xl shadow-md text-white p-6 relative overflow-hidden">
                <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 rounded-full bg-white opacity-10"></div>
                <h5 class="text-lg font-bold mb-4 flex items-center relative z-10">
                    <i class="fas fa-address-card text-blue-300 mr-2"></i> Info & Kontak
                </h5>
                <div class="space-y-4 relative z-10 text-sm text-blue-100">
                    <div class="flex items-start">
                        <i class="fas fa-map-marker-alt mt-1 mr-3 text-blue-300"></i>
                        <p>Jl. Atlas Tengah No.2, Babakan Surabaya, Kec. Kiaracondong, Kota Bandung</p>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-phone-alt mr-3 text-blue-300"></i>
                        <p>(022) 7234924</p>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-envelope mr-3 text-blue-300"></i>
                        <p>icbcintateknika@gmail.com</p>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-clock mt-1 mr-3 text-blue-300"></i>
                        <p>Senin - Jumat<br>08:00 - 15:00 WIB</p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
