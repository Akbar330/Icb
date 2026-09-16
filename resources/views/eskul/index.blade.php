@extends('layouts.main')

@section('title', 'Ekstrakurikuler - SMK ICB Cinta Teknika')

@section('content')
<div class="bg-gradient-to-b from-blue-50/60 via-white to-gray-50 py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Hero Header -->
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="inline-flex items-center gap-1.5 py-1 px-3.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 mb-4 tracking-wide uppercase">
                <i class="fas fa-trophy text-amber-500"></i> Bakat & Minat Siswa
            </span>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-gray-900 tracking-tight">
                Ekstrakurikuler <span class="text-blue-600">SMK ICB</span>
            </h1>
            <div class="w-20 h-1.5 bg-gradient-to-r from-blue-600 to-indigo-600 mx-auto mt-4 rounded-full"></div>
            <p class="text-gray-600 mt-4 text-base sm:text-lg leading-relaxed">
                Kembangkan potensi, kepemimpinan, dan kreativitas melalui beragam kegiatan ekstrakurikuler unggulan di SMK ICB Cinta Teknika.
            </p>

            <!-- Search & Filter Form -->
            <form action="{{ route('eskul.index') }}" method="GET" class="mt-8">
                <div class="flex flex-col sm:flex-row gap-3 justify-center max-w-xl mx-auto">
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <i class="fas fa-search text-sm"></i>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Cari eskul, pembina, atau kegiatan..."
                               class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm transition">
                    </div>
                    @if(request('kategori'))
                        <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                    @endif
                    <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-medium shadow-md shadow-blue-500/20 transition-all flex items-center justify-center gap-2">
                        <span>Cari</span>
                        <i class="fas fa-arrow-right text-xs"></i>
                    </button>
                    @if(request('search') || request('kategori'))
                        <a href="{{ route('eskul.index') }}" class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-xl text-sm font-medium transition flex items-center justify-center">
                            Reset
                        </a>
                    @endif
                </div>
            </form>

            <!-- Category Pills Filter -->
            <div class="flex flex-wrap items-center justify-center gap-2 mt-6">
                @foreach($kategoriList as $kat)
                    @php
                        $isActive = (request('kategori') == $kat) || (!request('kategori') && $kat == 'Semua');
                    @endphp
                    <a href="{{ route('eskul.index', array_merge(request()->except(['kategori', 'page']), $kat == 'Semua' ? [] : ['kategori' => $kat])) }}"
                       class="px-3.5 py-1.5 rounded-full text-xs font-medium transition-all duration-200 {{ $isActive ? 'bg-blue-600 text-white shadow-sm ring-2 ring-blue-600/30' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200' }}">
                        {{ $kat }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Section 1: Daftar Ekstrakurikuler -->
        <div class="mb-16">
            <div class="flex items-center justify-between mb-6 pb-2 border-b border-gray-200">
                <h2 class="text-xl sm:text-2xl font-bold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-th-large text-blue-600"></i> Pilihan Ekstrakurikuler
                </h2>
                <span class="text-xs font-semibold text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                    {{ $eskuls->total() }} Ekstrakurikuler
                </span>
            </div>

            @if($eskuls->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($eskuls as $eskul)
                        <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col overflow-hidden">
                            <!-- Image Cover with solid styling -->
                            <div style="height: 190px; width: 100%; position: relative; overflow: hidden; background: linear-gradient(135deg, #1e3a8a, #3b82f6);">
                                @if($eskul->foto)
                                    <img src="{{ asset('storage/' . $eskul->foto) }}" alt="{{ $eskul->nama_eskul }}"
                                         style="width: 100%; height: 100%; object-fit: cover; display: block;"
                                         class="transition duration-500 group-hover:scale-105">
                                    <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.65) 0%, rgba(0,0,0,0.1) 60%, transparent 100%);"></div>
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center text-white p-4">
                                        <div class="w-14 h-14 rounded-full bg-white/20 flex items-center justify-center text-2xl mb-1">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <span class="text-[10px] tracking-widest font-bold uppercase opacity-80">SMK ICB CT</span>
                                    </div>
                                @endif
                                <span style="position: absolute; top: 12px; right: 12px; background: rgba(255,255,255,0.95); color: #1d4ed8; padding: 4px 10px; border-radius: 9999px; font-size: 11px; font-weight: 700; box-shadow: 0 2px 4px rgba(0,0,0,0.12);">
                                    {{ $eskul->kategori }}
                                </span>
                            </div>

                            <!-- Content Body -->
                            <div class="p-5 flex-1 flex flex-col justify-between">
                                <div>
                                    <h3 class="text-base sm:text-lg font-bold text-gray-900 group-hover:text-blue-600 transition mb-2 line-clamp-1">
                                        {{ $eskul->nama_eskul }}
                                    </h3>
                                    
                                    <p class="text-gray-500 text-xs line-clamp-2 leading-relaxed mb-4">
                                        {{ $eskul->deskripsi ?: 'Kembangkan minat dan keahlianmu bersama ekstrakurikuler ' . $eskul->nama_eskul . ' di SMK ICB Cinta Teknika.' }}
                                    </p>

                                    <div class="space-y-1.5 text-xs text-gray-600 border-t border-gray-50 pt-3">
                                        @if($eskul->jadwal)
                                            <div class="flex items-center gap-2">
                                                <i class="far fa-clock text-blue-500 w-4 text-center"></i>
                                                <span class="truncate">{{ $eskul->jadwal }}</span>
                                            </div>
                                        @endif
                                        @if($eskul->pembina)
                                            <div class="flex items-center gap-2">
                                                <i class="fas fa-user-tie text-blue-500 w-4 text-center"></i>
                                                <span class="truncate">{{ $eskul->pembina }}</span>
                                            </div>
                                        @endif
                                        <div class="flex items-center gap-2 text-gray-500">
                                            <i class="far fa-newspaper text-indigo-500 w-4 text-center"></i>
                                            <span>{{ $eskul->kegiatans_count }} Artikel & Berita</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Button -->
                                <div class="mt-5 pt-3 border-t border-gray-100">
                                    <a href="{{ route('eskul.show', $eskul->slug) }}"
                                       class="w-full inline-flex items-center justify-center gap-2 py-2 px-4 rounded-xl text-xs font-semibold text-blue-600 bg-blue-50 hover:bg-blue-600 hover:text-white transition duration-200">
                                        <span>Lihat Profil & Liputan</span>
                                        <i class="fas fa-arrow-right text-[10px]"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($eskuls->hasPages())
                    <div class="mt-8 flex justify-center">
                        {{ $eskuls->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            @else
                <div class="max-w-md mx-auto text-center py-12 bg-white rounded-2xl border border-dashed border-gray-200 p-8">
                    <p class="text-gray-500 text-xs">Belum ada ekstrakurikuler yang sesuai dengan pencarian Anda.</p>
                </div>
            @endif
        </div>

        <!-- Section 2: Artikel & Berita dari SEMUA Eskul -->
        <div id="artikel-eskul" class="mt-16 pt-10 border-t-2 border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                <div>
                    <span class="inline-flex items-center gap-1 text-xs font-semibold text-blue-600 uppercase tracking-wider mb-1">
                        <i class="far fa-newspaper"></i> Warta & Liputan
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 tracking-tight">
                        Artikel & Berita Ekstrakurikuler
                    </h2>
                    <p class="text-gray-500 text-xs sm:text-sm mt-1">
                        Kabar terbaru, liputan kegiatan, dan dokumentasi prestasi dari seluruh ekstrakurikuler SMK ICB Cinta Teknika.
                    </p>
                </div>
                <span class="text-xs font-semibold px-3 py-1.5 rounded-full bg-blue-50 text-blue-700 self-start sm:self-auto">
                    Total: {{ $artikels->total() }} Artikel
                </span>
            </div>

            @if($artikels->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($artikels as $artikel)
                        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col group">
                            <!-- Article Cover Image -->
                            <div style="height: 200px; width: 100%; position: relative; overflow: hidden; background-color: #f3f4f6;">
                                @if($artikel->foto)
                                    <img src="{{ asset('storage/' . $artikel->foto) }}" alt="{{ $artikel->judul }}"
                                         style="width: 100%; height: 100%; object-fit: cover; display: block;"
                                         class="group-hover:scale-105 transition duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        <i class="far fa-newspaper text-3xl"></i>
                                    </div>
                                @endif
                                @if($artikel->eskul)
                                    <span style="position: absolute; top: 12px; left: 12px; background: rgba(30, 58, 138, 0.9); color: #ffffff; padding: 4px 10px; border-radius: 9999px; font-size: 11px; font-weight: 700; backdrop-filter: blur(4px);">
                                        {{ $artikel->eskul->nama_eskul }}
                                    </span>
                                @endif
                                @if($artikel->tanggal_kegiatan)
                                    <span style="position: absolute; bottom: 10px; right: 12px; background: rgba(255, 255, 255, 0.95); color: #374151; padding: 3px 8px; border-radius: 6px; font-size: 10px; font-weight: 600;">
                                        <i class="far fa-calendar-alt text-blue-600 mr-1"></i>
                                        {{ \Carbon\Carbon::parse($artikel->tanggal_kegiatan)->isoFormat('D MMM Y') }}
                                    </span>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="p-5 flex-1 flex flex-col justify-between">
                                <div>
                                    <h3 class="text-base font-bold text-gray-900 group-hover:text-blue-600 transition mb-2 leading-snug line-clamp-2">
                                        <a href="{{ route('eskul.artikel.show', $artikel->slug) }}">
                                            {{ $artikel->judul }}
                                        </a>
                                    </h3>
                                    <p class="text-gray-500 text-xs line-clamp-3 leading-relaxed mb-4">
                                        {{ $artikel->deskripsi }}
                                    </p>
                                </div>

                                <div class="pt-3 border-t border-gray-100 flex items-center justify-between">
                                    <span class="text-[11px] text-gray-400">
                                        <i class="far fa-user mr-1"></i> {{ $artikel->penulis ?: ($artikel->user ? $artikel->user->name : 'Pengurus Eskul') }}
                                    </span>
                                    <a href="{{ route('eskul.artikel.show', $artikel->slug) }}"
                                       class="inline-flex items-center gap-1 text-xs font-bold text-blue-600 hover:text-blue-800 transition">
                                        <span>Baca Artikel</span>
                                        <i class="fas fa-arrow-right text-[10px]"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($artikels->hasPages())
                    <div class="mt-8 flex justify-center">
                        {{ $artikels->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            @else
                <div class="text-center py-12 bg-white rounded-2xl border border-dashed border-gray-200 p-6">
                    <i class="far fa-newspaper text-3xl text-gray-300 mb-2 block"></i>
                    <h4 class="text-sm font-bold text-gray-700">Belum Ada Artikel Ekstrakurikuler</h4>
                    <p class="text-gray-400 text-xs mt-1">Pengurus ekstrakurikuler akan segera mempublikasikan artikel dan kegiatan terbaru di sini.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
