@extends('layouts.main')

@section('title', $artikel->judul . ' - Berita Eskul SMK ICB')

@section('content')
<div class="bg-gray-50/60 py-10">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
        <!-- Breadcrumb / Back Button -->
        <div class="mb-6 flex items-center justify-between">
            <nav class="flex items-center gap-2 text-xs text-gray-500">
                <a href="/" class="hover:text-blue-600 transition"><i class="fas fa-home"></i> Home</a>
                <span>/</span>
                <a href="{{ route('eskul.index') }}" class="hover:text-blue-600 transition">Ekstrakurikuler</a>
                @if($artikel->eskul)
                    <span>/</span>
                    <a href="{{ route('eskul.show', $artikel->eskul->slug) }}" class="hover:text-blue-600 transition">{{ $artikel->eskul->nama_eskul }}</a>
                @endif
            </nav>
            <a href="{{ url()->previous() ?: route('eskul.index') }}" class="inline-flex items-center text-xs font-semibold text-blue-600 hover:text-blue-800 bg-white border border-gray-200 px-3.5 py-1.5 rounded-lg shadow-sm transition">
                <i class="fas fa-arrow-left mr-1.5 text-[10px]"></i> Kembali
            </a>
        </div>

        <!-- Article Container -->
        <article class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden p-6 sm:p-10">
            <!-- Header Meta -->
            <div class="mb-6">
                @if($artikel->eskul)
                    <a href="{{ route('eskul.show', $artikel->eskul->slug) }}" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 hover:bg-blue-100 transition mb-3">
                        <i class="fas fa-trophy text-amber-500 text-[11px]"></i>
                        <span>{{ $artikel->eskul->nama_eskul }}</span>
                        <span class="text-blue-300">•</span>
                        <span>{{ $artikel->eskul->kategori }}</span>
                    </a>
                @endif

                <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight leading-tight mb-4">
                    {{ $artikel->judul }}
                </h1>

                <!-- Meta Details -->
                <div class="flex flex-wrap items-center gap-4 text-xs text-gray-500 pb-4 border-b border-gray-100">
                    <span class="flex items-center text-gray-700 font-medium">
                        <i class="far fa-user-circle mr-1.5 text-blue-600 text-sm"></i>
                        {{ $artikel->penulis ?: ($artikel->user ? $artikel->user->name : 'Pengurus Eskul') }}
                    </span>
                    @if($artikel->tanggal_kegiatan)
                        <span class="flex items-center">
                            <i class="far fa-calendar-alt mr-1.5 text-gray-400"></i>
                            {{ \Carbon\Carbon::parse($artikel->tanggal_kegiatan)->isoFormat('D MMMM Y') }}
                        </span>
                    @endif
                    <span class="flex items-center">
                        <i class="far fa-eye mr-1.5 text-gray-400"></i>
                        {{ $artikel->views ?? 0 }} kali dibaca
                    </span>
                </div>
            </div>

            <!-- Featured Image Cover -->
            @if($artikel->foto)
                <div class="w-full mb-8 rounded-2xl overflow-hidden bg-gray-100 border border-gray-100 shadow-sm flex items-center justify-center">
                    <img src="{{ asset('storage/' . $artikel->foto) }}" alt="{{ $artikel->judul }}"
                         class="w-full h-auto max-h-[480px] object-cover"
                         style="width: 100%; max-height: 480px; object-fit: cover; display: block;">
                </div>
            @endif

            <!-- Summary Excerpt if present -->
            @if($artikel->deskripsi && $artikel->konten)
                <div class="p-4 rounded-xl bg-blue-50/60 border-l-4 border-blue-600 text-xs sm:text-sm text-gray-700 italic mb-8 leading-relaxed">
                    {{ $artikel->deskripsi }}
                </div>
            @endif

            <!-- Rich Content from TinyMCE -->
            <div class="prose prose-blue max-w-none text-gray-800 text-sm sm:text-base leading-relaxed text-justify space-y-4">
                @if($artikel->konten)
                    {!! $artikel->konten !!}
                @else
                    {!! nl2br(e($artikel->deskripsi)) !!}
                @endif
            </div>

            <!-- Share Section -->
            <div class="mt-12 pt-6 border-t border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">
                <span class="text-xs text-gray-500 font-semibold">Bagikan artikel eskul ini:</span>
                <div class="flex gap-2">
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($artikel->judul . ' - ' . Request::fullUrl()) }}" target="_blank"
                       class="w-9 h-9 rounded-xl bg-emerald-500 text-white flex items-center justify-center hover:bg-emerald-600 transition shadow-sm text-sm" title="WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}" target="_blank"
                       class="w-9 h-9 rounded-xl bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition shadow-sm text-sm" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::fullUrl()) }}&text={{ urlencode($artikel->judul) }}" target="_blank"
                       class="w-9 h-9 rounded-xl bg-sky-500 text-white flex items-center justify-center hover:bg-sky-600 transition shadow-sm text-sm" title="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                </div>
            </div>
        </article>

        <!-- Artikel Eskul Lainnya -->
        @if(isset($artikelLainnya) && $artikelLainnya->count() > 0)
            <div class="mt-10">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Berita & Artikel Eskul Lainnya</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($artikelLainnya as $other)
                        <a href="{{ route('eskul.artikel.show', $other->slug) }}"
                           class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-blue-200 transition group flex gap-4 items-center">
                            <div style="width: 80px; height: 60px; min-width: 80px; overflow: hidden; border-radius: 10px; background-color: #f3f4f6;">
                                @if($other->foto)
                                    <img src="{{ asset('storage/' . $other->foto) }}" alt="{{ $other->judul }}" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400"><i class="far fa-newspaper"></i></div>
                                @endif
                            </div>
                            <div class="min-w-0 flex-1">
                                <span class="text-[10px] font-semibold text-blue-600 uppercase tracking-wider block">
                                    {{ $other->eskul ? $other->eskul->nama_eskul : 'Ekstrakurikuler' }}
                                </span>
                                <h4 class="text-xs sm:text-sm font-bold text-gray-900 group-hover:text-blue-600 transition line-clamp-1">
                                    {{ $other->judul }}
                                </h4>
                                <span class="text-[11px] text-gray-400 mt-1 block">
                                    {{ $other->tanggal_kegiatan ? \Carbon\Carbon::parse($other->tanggal_kegiatan)->format('d M Y') : '' }}
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
