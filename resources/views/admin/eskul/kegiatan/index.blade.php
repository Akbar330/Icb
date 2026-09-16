@extends('layouts.admin')

@section('title', 'Dokumentasi & Berita Kegiatan Eskul')

@section('content')
<div class="space-y-6">
    <!-- Header Page -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <div>
            <h1 class="text-xl font-bold text-gray-800">
                @if(auth()->user()->role === 'eskul' && auth()->user()->eskul)
                    Berita & Kegiatan: {{ auth()->user()->eskul->nama_eskul }}
                @else
                    Dokumentasi & Berita Kegiatan Eskul
                @endif
            </h1>
            <p class="text-xs text-gray-500 mt-1">Unggah dokumentasi foto dan berita kegiatan ekstrakurikuler untuk ditampilkan di halaman website sekolah.</p>
        </div>
        <div class="flex items-center gap-3">
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.eskul.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-xs font-semibold transition flex items-center gap-1.5">
                    <i class="fas fa-trophy"></i> Master Eskul
                </a>
            @endif
            <a href="{{ route('admin.kegiatan-eskul.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-semibold shadow-md shadow-blue-500/20 transition flex items-center gap-1.5">
                <i class="fas fa-plus"></i> Posting Kegiatan
            </a>
        </div>
    </div>

    <!-- Filter (Super Admin Only) -->
    @if(auth()->user()->role === 'admin' && $eskulList->count() > 1)
        <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-3 text-xs">
            <span class="font-semibold text-gray-600"><i class="fas fa-filter text-blue-500 mr-1"></i> Filter Eskul:</span>
            <form action="{{ route('admin.kegiatan-eskul.index') }}" method="GET" class="flex items-center gap-2 m-0">
                <select name="eskul_id" onchange="this.form.submit()" class="px-3 py-1.5 bg-gray-50 border border-gray-200 rounded-lg text-xs text-gray-700 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    <option value="">Semua Ekstrakurikuler</option>
                    @foreach($eskulList as $e)
                        <option value="{{ $e->id }}" {{ request('eskul_id') == $e->id ? 'selected' : '' }}>{{ $e->nama_eskul }}</option>
                    @endforeach
                </select>
                @if(request('eskul_id'))
                    <a href="{{ route('admin.kegiatan-eskul.index') }}" class="text-gray-400 hover:text-gray-600 text-xs">Reset</a>
                @endif
            </form>
        </div>
    @endif

    <!-- Table Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-gray-500 font-semibold uppercase tracking-wider">
                        <th class="py-3.5 px-4 w-12 text-center">#</th>
                        <th class="py-3.5 px-4 w-28">Foto</th>
                        <th class="py-3.5 px-4">Judul & Keterangan</th>
                        <th class="py-3.5 px-4">Ekstrakurikuler</th>
                        <th class="py-3.5 px-4">Tanggal Kegiatan</th>
                        <th class="py-3.5 px-4">Uploader</th>
                        <th class="py-3.5 px-4 text-center w-28">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($kegiatans as $index => $item)
                        <tr class="hover:bg-gray-50/80 transition">
                            <td class="py-3.5 px-4 text-center font-medium text-gray-400">
                                {{ $kegiatans->firstItem() + $index }}
                            </td>
                            <td class="py-3.5 px-4">
                                <div style="width: 72px; height: 48px; min-width: 72px; min-height: 48px; max-width: 72px; max-height: 48px; overflow: hidden; border-radius: 8px; background-color: #f3f4f6; flex-shrink: 0; display: flex; align-items: center; justify-content: center; border: 1px solid #e5e7eb;">
                                    @if($item->foto)
                                        <a href="{{ asset('storage/' . $item->foto) }}" target="_blank" style="width: 100%; height: 100%; display: block;">
                                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}" style="width: 100%; height: 100%; object-fit: cover; display: block; border-radius: 7px;">
                                        </a>
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                                            <i class="far fa-image"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="font-bold text-gray-900 block">{{ $item->judul }}</span>
                                <span class="text-[11px] text-gray-400 block line-clamp-1 max-w-sm mt-0.5">{{ $item->deskripsi }}</span>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-indigo-50 text-indigo-700">
                                    {{ $item->eskul ? $item->eskul->nama_eskul : 'Umum' }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-gray-600">
                                {{ $item->tanggal_kegiatan ? \Carbon\Carbon::parse($item->tanggal_kegiatan)->format('d M Y') : '-' }}
                            </td>
                            <td class="py-3.5 px-4 text-gray-500">
                                {{ $item->user ? $item->user->name : '-' }}
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    <a href="{{ route('admin.kegiatan-eskul.edit', $item->id) }}" class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 flex items-center justify-center transition" title="Edit">
                                        <i class="fas fa-pencil-alt text-xs"></i>
                                    </a>
                                    <form action="{{ route('admin.kegiatan-eskul.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus dokumentasi kegiatan ini?')" class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 flex items-center justify-center transition" title="Hapus">
                                            <i class="fas fa-trash-alt text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-10 text-gray-400 italic">
                                Belum ada berita atau kegiatan eskul yang diunggah. Silakan klik "Posting Kegiatan".
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($kegiatans->hasPages())
            <div class="p-4 border-t border-gray-100 flex justify-center">
                {{ $kegiatans->links('pagination::bootstrap-4') }}
            </div>
        @endif
    </div>
</div>
@endsection
