@extends('layouts.main')

@section('title', $eskul->nama_eskul . ' - Ekstrakurikuler SMK ICB')

@section('content')
<div class="bg-gray-50/70 py-10">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs text-gray-500 mb-6">
            <a href="/" class="hover:text-blue-600 transition"><i class="fas fa-home mr-1"></i> Home</a>
            <span>/</span>
            <a href="{{ route('eskul.index') }}" class="hover:text-blue-600 transition">Ekstrakurikuler</a>
            <span>/</span>
            <span class="text-gray-800 font-medium">{{ $eskul->nama_eskul }}</span>
        </nav>

        <!-- Main Banner Profile Card -->
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden mb-10">
            <div style="height: 280px; width: 100%; position: relative; overflow: hidden; background: linear-gradient(135deg, #1e3a8a, #3b82f6);">
                @if($eskul->foto)
                    <img src="{{ asset('storage/' . $eskul->foto) }}" alt="{{ $eskul->nama_eskul }}"
                         style="width: 100%; height: 100%; object-fit: cover; display: block;">
                    <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.25) 60%, transparent 100%);"></div>
                @endif
                
                <div class="absolute bottom-6 left-6 right-6 flex flex-col sm:flex-row sm:items-end justify-between gap-4 text-white">
                    <div>
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-blue-500/80 backdrop-blur-md text-white mb-2">
                            {{ $eskul->kategori }}
                        </span>
                        <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight">
                            {{ $eskul->nama_eskul }}
                        </h1>
                        <p class="text-blue-100 text-xs sm:text-sm mt-1">Ekstrakurikuler Resmi SMK ICB Cinta Teknika</p>
                    </div>
                    <a href="#kegiatan" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white text-gray-900 text-xs font-semibold hover:bg-blue-50 hover:text-blue-600 shadow-md transition self-start sm:self-auto">
                        <i class="far fa-images text-blue-600"></i>
                        <span>Lihat Dokumentasi Kegiatan</span>
                    </a>
                </div>
            </div>

            <!-- Meta Quick Info Bar -->
            <div class="grid grid-cols-2 md:grid-cols-4 divide-y md:divide-y-0 md:divide-x divide-gray-100 border-b border-gray-100 bg-white">
                <div class="p-4 sm:p-5 flex items-center gap-3.5">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
                        <i class="far fa-clock text-base"></i>
                    </div>
                    <div class="min-w-0">
                        <span class="block text-[11px] text-gray-400 font-medium uppercase tracking-wider">Jadwal Latihan</span>
                        <span class="block text-xs sm:text-sm font-semibold text-gray-800 truncate">{{ $eskul->jadwal ?: '-' }}</span>
                    </div>
                </div>

                <div class="p-4 sm:p-5 flex items-center gap-3.5">
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-map-marker-alt text-base"></i>
                    </div>
                    <div class="min-w-0">
                        <span class="block text-[11px] text-gray-400 font-medium uppercase tracking-wider">Lokasi / Tempat</span>
                        <span class="block text-xs sm:text-sm font-semibold text-gray-800 truncate">{{ $eskul->tempat ?: 'Lingkungan Sekolah' }}</span>
                    </div>
                </div>

                <div class="p-4 sm:p-5 flex items-center gap-3.5">
                    <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-user-tie text-base"></i>
                    </div>
                    <div class="min-w-0">
                        <span class="block text-[11px] text-gray-400 font-medium uppercase tracking-wider">Pembina Eskul</span>
                        <span class="block text-xs sm:text-sm font-semibold text-gray-800 truncate">{{ $eskul->pembina ?: '-' }}</span>
                    </div>
                </div>

                <div class="p-4 sm:p-5 flex items-center gap-3.5">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-user-shield text-base"></i>
                    </div>
                    <div class="min-w-0">
                        <span class="block text-[11px] text-gray-400 font-medium uppercase tracking-wider">Ketua Eskul</span>
                        <span class="block text-xs sm:text-sm font-semibold text-gray-800 truncate">{{ $eskul->ketua ?: '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Description & Profile -->
            <div class="p-6 sm:p-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 space-y-6">
                        <div>
                            <h2 class="text-base sm:text-lg font-bold text-gray-900 mb-3 flex items-center gap-2">
                                <i class="fas fa-info-circle text-blue-600"></i> Tentang Ekstrakurikuler
                            </h2>
                            <div class="text-gray-600 text-sm leading-relaxed whitespace-pre-line">
                                {{ $eskul->deskripsi ?: 'Belum ada deskripsi profil untuk ekstrakurikuler ini.' }}
                            </div>
                        </div>

                        @if($eskul->visi_misi)
                            <div class="pt-6 border-t border-gray-100">
                                <h2 class="text-base sm:text-lg font-bold text-gray-900 mb-3 flex items-center gap-2">
                                    <i class="fas fa-bullseye text-indigo-600"></i> Visi & Misi Kegiatan
                                </h2>
                                <div class="text-gray-600 text-sm leading-relaxed whitespace-pre-line bg-gray-50 p-4 rounded-2xl border border-gray-100">
                                    {{ $eskul->visi_misi }}
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Call to action / SPMB banner -->
                    <div class="bg-gradient-to-br from-blue-600 to-indigo-700 text-white p-6 rounded-2xl shadow-lg flex flex-col justify-between">
                        <div>
                            <span class="inline-block px-2.5 py-1 rounded-md text-[11px] font-bold bg-white/20 uppercase tracking-wider mb-3">
                                Gabung Bersama Kami
                            </span>
                            <h3 class="text-xl font-bold mb-2">Tertarik dengan {{ $eskul->nama_eskul }}?</h3>
                            <p class="text-blue-100 text-xs leading-relaxed mb-6">
                                Raih prestasi dan kembangkan potensi terbaikmu di SMK ICB Cinta Teknika. Pendaftaran siswa baru telah dibuka!
                            </p>
                        </div>
                        <a href="https://spmb.smkicbcintateknika.sch.id/" target="_blank"
                           class="w-full text-center py-2.5 px-4 bg-white text-blue-700 font-bold text-xs rounded-xl shadow-md hover:bg-blue-50 transition">
                            Daftar Sekarang (SPMB)
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activities & News Gallery Section -->
        <div id="kegiatan" class="mb-12">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">
                        Dokumentasi & Berita Kegiatan
                    </h2>
                    <p class="text-gray-500 text-xs sm:text-sm mt-1">
                        Dokumentasi momen, prestasi, dan kegiatan terbaru dari ekstrakurikuler {{ $eskul->nama_eskul }}.
                    </p>
                </div>
                <span class="text-xs font-semibold px-3 py-1.5 rounded-full bg-blue-50 text-blue-700 self-start sm:self-auto">
                    Total: {{ $kegiatans->total() }} Kegiatan
                </span>
            </div>

            @if($kegiatans->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($kegiatans as $kegiatan)
                        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition overflow-hidden flex flex-col group">
                            <!-- Activity Image -->
                            <div class="relative h-52 bg-gray-100 overflow-hidden">
                                @if($kegiatan->foto)
                                    <img src="{{ asset('storage/' . $kegiatan->foto) }}" alt="{{ $kegiatan->judul }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400">
                                        <i class="far fa-image text-3xl"></i>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                                    <a href="{{ asset('storage/' . $kegiatan->foto) }}" target="_blank"
                                       class="px-3 py-1.5 bg-white/90 backdrop-blur-sm text-gray-900 rounded-lg text-xs font-semibold shadow hover:bg-white transition flex items-center gap-1.5">
                                        <i class="fas fa-search-plus"></i> Lihat Foto Penuh
                                    </a>
                                </div>
                                @if($kegiatan->tanggal_kegiatan)
                                    <span class="absolute top-3 left-3 px-2.5 py-1 rounded-lg text-[11px] font-semibold bg-white/90 backdrop-blur-sm text-gray-800 shadow-sm">
                                        <i class="far fa-calendar-alt text-blue-600 mr-1"></i>
                                        {{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->isoFormat('D MMMM Y') }}
                                    </span>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="p-5 flex-1 flex flex-col justify-between">
                                <div>
                                    <h3 class="text-base font-bold text-gray-900 group-hover:text-blue-600 transition mb-2 leading-snug">
                                        <a href="{{ route('eskul.artikel.show', $kegiatan->slug) }}">
                                            {{ $kegiatan->judul }}
                                        </a>
                                    </h3>
                                    <div class="text-gray-600 text-xs leading-relaxed line-clamp-3 mb-3">
                                        {{ $kegiatan->deskripsi }}
                                    </div>
                                </div>
                                <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between">
                                    <span class="text-[11px] text-gray-400">
                                        <i class="far fa-user mr-1"></i> {{ $kegiatan->penulis ?: ($kegiatan->user ? $kegiatan->user->name : 'Pengurus Eskul') }}
                                    </span>
                                    <a href="{{ route('eskul.artikel.show', $kegiatan->slug) }}"
                                       class="inline-flex items-center gap-1 text-xs font-semibold text-blue-600 hover:text-blue-800">
                                        <span>Baca Artikel</span>
                                        <i class="fas fa-arrow-right text-[9px]"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8 flex justify-center">
                    {{ $kegiatans->links('pagination::bootstrap-4') }}
                </div>
            @else
                <div class="text-center py-12 bg-white rounded-2xl border border-dashed border-gray-200 p-6">
                    <div class="w-12 h-12 bg-gray-50 text-gray-400 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="far fa-images text-xl"></i>
                    </div>
                    <h4 class="text-sm font-bold text-gray-700">Belum Ada Dokumentasi Kegiatan</h4>
                    <p class="text-gray-400 text-xs mt-1">Pengurus eskul {{ $eskul->nama_eskul }} belum mengunggah kegiatan terkini.</p>
                </div>
            @endif
        </div>

        <!-- Eskul Lainnya Section -->
        @if($eskulLainnya->count() > 0)
            <div class="pt-8 border-t border-gray-200">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Ekstrakurikuler Lainnya di SMK ICB</h3>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    @foreach($eskulLainnya as $other)
                        <a href="{{ route('eskul.show', $other->slug) }}"
                           class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm hover:shadow-md hover:border-blue-200 transition group flex flex-col justify-between">
                            <div>
                                <span class="text-[10px] font-semibold text-blue-600 uppercase tracking-wider block mb-1">
                                    {{ $other->kategori }}
                                </span>
                                <h4 class="text-xs sm:text-sm font-bold text-gray-800 group-hover:text-blue-600 transition truncate">
                                    {{ $other->nama_eskul }}
                                </h4>
                            </div>
                            <span class="text-[11px] text-gray-400 mt-2 block flex items-center gap-1 group-hover:text-blue-500">
                                <span>Selengkapnya</span>
                                <i class="fas fa-arrow-right text-[9px]"></i>
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
