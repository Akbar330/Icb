@extends('layouts.main')

@section('title', 'Informasi')

@section('content')
    <div class="container py-12">
        <div class="row">
            <!-- Left Section: Daftar Informasi (70%) -->
            <div class="col-lg-8 mb-5">
                <div class="mb-8 border-b border-gray-200 pb-4">
                    <h1 class="text-4xl font-bold text-gray-800 border-l-4 border-blue-600 pl-4">Informasi Terbaru</h1>
                    <p class="text-gray-500 mt-2 ml-1">Kumpulan pengumuman dan informasi resmi dari sekolah.</p>
                </div>

                <div class="space-y-6">
                    <!-- Static Visi Misi Card -->
                    <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-xl shadow-md hover-card overflow-hidden border border-blue-700 flex flex-col sm:flex-row text-white">
                        <div class="p-6 flex-grow flex flex-col justify-between w-full">
                            <div>
                                <h3 class="text-2xl font-bold mb-2">
                                    <i class="fas fa-bullseye mr-2 text-yellow-400"></i> VISI-MISI
                                </h3>
                                <p class="text-blue-100 text-sm leading-relaxed mb-4">
                                    Lihat Visi-Misi sekolah kami selengkapnya untuk mengetahui arah dan tujuan pendidikan.
                                </p>
                            </div>
                            <div class="mt-auto">
                                <a href="/visi-misi" class="btn btn-sm bg-white text-blue-700 rounded-full px-5 font-semibold hover:bg-gray-100 transition-colors inline-block">
                                    Baca Visi & Misi <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Dynamic Informasi -->
                    @forelse($informasi as $item)
                        <div class="bg-white rounded-xl shadow-sm hover-card overflow-hidden border border-gray-100 flex flex-col sm:flex-row">
                            <div class="p-5 flex-grow flex flex-col justify-between w-full">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800 hover:text-blue-600 transition-colors mb-2">
                                        <a href="{{ route('informasi.show', $item->id) }}" class="text-decoration-none text-inherit">
                                            {{ $item->judul }}
                                        </a>
                                    </h3>
                                    <p class="text-gray-600 text-sm leading-relaxed mb-4">
                                        {{ \Illuminate\Support\Str::limit($item->konten, 180) }}
                                    </p>
                                </div>
                                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mt-auto pt-4 border-t border-gray-50 gap-4 sm:gap-0">
                                    <div class="text-xs text-gray-500 flex items-center space-x-4">
                                        <span><i class="far fa-calendar-alt mr-1 text-blue-500"></i> {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</span>
                                        <span><i class="fas fa-eye mr-1 text-blue-500"></i> {{ $item->views }} dilihat</span>
                                    </div>
                                    <a href="{{ route('informasi.show', $item->id) }}" class="btn btn-sm btn-outline-primary rounded-full px-4 font-semibold hover:bg-blue-600 hover:text-white transition-colors w-full sm:w-auto text-center">
                                        Selengkapnya
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                            <p class="text-gray-500 italic">Belum ada informasi terbaru.</p>
                        </div>
                    @endforelse
                </div>

                <div class="d-flex justify-content-center mt-8">
                    {{ $informasi->links('pagination::bootstrap-4') }}
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
                                @forelse ($artikels->take(4) as $artikel)
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
