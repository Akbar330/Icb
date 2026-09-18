@extends('layouts.main')

@section('title', 'Berita')

@section('content')
    <div class="container py-12">
        <div class="row">
            <!-- Left Section: Daftar Berita (70%) -->
            <div class="col-lg-8 mb-5">
                <div class="mb-8 border-b border-gray-200 pb-4">
                    <h1 class="text-4xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4">Berita Sekolah</h1>
                    <p class="text-gray-500 mt-2 ml-1">Kumpulan informasi dan berita terbaru dari sekolah.</p>
                </div>

                <div class="space-y-6">
                    @forelse ($beritas as $berita)
                        <div class="bg-white rounded-xl shadow-sm hover-card overflow-hidden border border-gray-100 flex flex-col sm:flex-row">
                            @if ($berita->gambar)
                                <div class="sm:w-1/3 h-48 sm:h-auto overflow-hidden relative bg-gray-50 flex items-center justify-center">
                                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" class="w-full h-full object-contain p-2 transition duration-500 hover:scale-110" loading="lazy">
                                </div>
                            @endif
                            <div class="p-5 flex-grow flex flex-col justify-between {{ $berita->gambar ? 'sm:w-2/3' : 'w-full' }}">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800 hover:text-blue-600 transition-colors mb-2">
                                        <a href="{{ route('berita.show', $berita->id) }}" class="text-decoration-none text-inherit">
                                            {{ $berita->judul }}
                                        </a>
                                    </h3>
                                    <p class="text-gray-600 text-sm leading-relaxed mb-4">
                                        {{ \Illuminate\Support\Str::limit($berita->deskripsi, 120) }}
                                    </p>
                                </div>
                                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mt-auto pt-4 border-t border-gray-50 gap-4 sm:gap-0">
                                    <div class="text-xs text-gray-500 flex flex-col sm:flex-row sm:items-center">
                                        <span class="mb-1 sm:mb-0 sm:mr-3"><i class="fas fa-user-edit mr-1"></i> {{ $berita->penulis }}</span>
                                        <span><i class="far fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($berita->created_at)->format('d M Y') }}</span>
                                    </div>
                                    <a href="{{ route('berita.show', $berita->id) }}" class="btn btn-sm btn-outline-primary rounded-full px-4 font-semibold hover:bg-blue-600 hover:text-white transition-colors w-full sm:w-auto text-center">
                                        Baca
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                            <p class="text-gray-500 italic">Belum ada berita yang diterbitkan.</p>
                        </div>
                    @endforelse
                </div>

                <div class="d-flex justify-content-center mt-8">
                    {{ $beritas->links('pagination::bootstrap-4') }}
                </div>
            </div>

            <!-- Right Section: Kontak Sekolah (30%) -->
            <div class="col-lg-4 mb-5">
                <div class="sticky-top space-y-6" style="top: 100px; z-index: 10;">
                    <!-- Card Gabungan -->
                    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                        <div class="bg-blue-600 text-white py-3 px-4">
                            <h5 class="font-bold m-0 text-base flex items-center"><i class="fas fa-address-book mr-2"></i> Kontak Sekolah</h5>
                        </div>
                        <div class="p-5">
                            <ul class="space-y-4">
                                <li class="flex items-start text-sm text-gray-600">
                                    <i class="fas fa-map-marker-alt mt-1 mr-3 text-blue-500 w-4 text-center"></i>
                                    <span>Jl. Atlas Tengah No.2, Babakan Surabaya, Kec. Kiaracondong, Kota Bandung, Jawa Barat 40281</span>
                                </li>
                                <li class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-phone-alt mr-3 text-blue-500 w-4 text-center"></i>
                                    <span>(022) 7234924</span>
                                </li>
                                <li class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-envelope mr-3 text-blue-500 w-4 text-center"></i>
                                    <span>icbcintateknika@gmail.com</span>
                                </li>
                                <li class="flex items-start text-sm text-gray-600">
                                    <i class="fas fa-clock mt-1 mr-3 text-blue-500 w-4 text-center"></i>
                                    <span>Senin - Jumat, 08.00 - 15.00</span>
                                </li>
                            </ul>

                            <hr class="my-5 border-gray-100">

                            <!-- Form Pencarian Artikel -->
                            <h6 class="font-bold text-gray-800 mb-3 text-sm uppercase tracking-wider flex items-center"><i class="fas fa-search mr-2 text-blue-500"></i> Cari Artikel</h6>
                            <form action="{{ route('artikel.search') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" name="query" class="form-control border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 rounded-l-md text-sm" placeholder="Cari..." required>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary rounded-r-md" type="submit"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>

                            <hr class="my-5 border-gray-100">

                            <!-- Daftar Artikel Terkini -->
                            <h6 class="font-bold text-gray-800 mb-3 text-sm uppercase tracking-wider flex items-center"><i class="fas fa-newspaper mr-2 text-blue-500"></i> Artikel Terkini</h6>
                            <div class="space-y-4">
                                @forelse ($artikels as $artikel)
                                    <div class="group">
                                        <a href="{{ route('artikel.show', $artikel->id) }}" class="text-decoration-none">
                                            <h6 class="font-semibold text-gray-800 text-sm group-hover:text-blue-600 transition-colors leading-snug mb-1">{{ $artikel->judul }}</h6>
                                        </a>
                                        <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed mb-1">{{ Str::limit($artikel->deskripsi, 80) }}</p>
                                        <div class="text-xs text-gray-400 font-medium"><i class="far fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($artikel->created_at)->format('d M Y') }}</div>
                                    </div>
                                @empty
                                    <p class="text-sm text-gray-500 italic">Belum ada artikel.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
