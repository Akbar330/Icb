@extends('layouts.admin')

@section('title', 'Manajemen Ekstrakurikuler')

@section('content')
<div class="space-y-6">
    <!-- Header Page -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <div>
            <h1 class="text-xl font-bold text-gray-800">Daftar Ekstrakurikuler</h1>
            <p class="text-xs text-gray-500 mt-1">Kelola data ekstrakurikuler sekolah, pembina, jadwal latihan, dan kegiatannya.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.kegiatan-eskul.index') }}" class="px-4 py-2 bg-indigo-50 text-indigo-700 hover:bg-indigo-100 rounded-xl text-xs font-semibold transition flex items-center gap-1.5">
                <i class="fas fa-calendar-alt"></i> Kelola Kegiatan
            </a>
            <a href="{{ route('admin.eskul.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-semibold shadow-md shadow-blue-500/20 transition flex items-center gap-1.5">
                <i class="fas fa-plus"></i> Tambah Eskul
            </a>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-gray-500 font-semibold uppercase tracking-wider">
                        <th class="py-3.5 px-4 w-12 text-center">#</th>
                        <th class="py-3.5 px-4">Eskul</th>
                        <th class="py-3.5 px-4">Kategori</th>
                        <th class="py-3.5 px-4">Pembina / Pelatih</th>
                        <th class="py-3.5 px-4">Jadwal & Lokasi</th>
                        <th class="py-3.5 px-4 text-center">Kegiatan</th>
                        <th class="py-3.5 px-4 text-center">Akun Pengurus</th>
                        <th class="py-3.5 px-4 text-center w-28">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($eskuls as $index => $eskul)
                        <tr class="hover:bg-gray-50/80 transition">
                            <td class="py-3.5 px-4 text-center font-medium text-gray-400">
                                {{ $eskuls->firstItem() + $index }}
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="flex items-center gap-3">
                                    <div style="width: 48px; height: 48px; min-width: 48px; min-height: 48px; max-width: 48px; max-height: 48px; overflow: hidden; border-radius: 10px; background-color: #f3f4f6; flex-shrink: 0; display: flex; align-items: center; justify-content: center; border: 1px solid #e5e7eb;">
                                        @if($eskul->foto)
                                            <img src="{{ asset('storage/' . $eskul->foto) }}" alt="{{ $eskul->nama_eskul }}" style="width: 100%; height: 100%; object-fit: cover; display: block; border-radius: 9px;">
                                        @else
                                            <i class="fas fa-users text-gray-400 text-sm"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <a href="{{ route('eskul.show', $eskul->slug) }}" target="_blank" class="font-bold text-gray-900 hover:text-blue-600 transition flex items-center gap-1">
                                            {{ $eskul->nama_eskul }}
                                            <i class="fas fa-external-link-alt text-[9px] text-gray-400"></i>
                                        </a>
                                        <span class="text-[11px] text-gray-400 block line-clamp-1 max-w-xs">{{ $eskul->deskripsi }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-blue-50 text-blue-700">
                                    {{ $eskul->kategori }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-gray-700">
                                {{ $eskul->pembina ?: '-' }}
                            </td>
                            <td class="py-3.5 px-4 text-gray-600">
                                <div>{{ $eskul->jadwal ?: '-' }}</div>
                                <div class="text-[11px] text-gray-400">{{ $eskul->tempat ?: '' }}</div>
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                <a href="{{ route('admin.kegiatan-eskul.index', ['eskul_id' => $eskul->id]) }}" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-gray-100 hover:bg-gray-200 font-semibold text-gray-700 transition">
                                    <i class="far fa-images text-indigo-500"></i>
                                    <span>{{ $eskul->kegiatans_count }}</span>
                                </a>
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                <span class="inline-flex items-center gap-1 text-[11px] text-gray-600">
                                    <i class="fas fa-user-check text-emerald-500"></i>
                                    {{ $eskul->users_count }} user
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    <a href="{{ route('admin.eskul.edit', $eskul->id) }}" class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 flex items-center justify-center transition" title="Edit">
                                        <i class="fas fa-pencil-alt text-xs"></i>
                                    </a>
                                    <form action="{{ route('admin.eskul.destroy', $eskul->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus eskul ini? Seluruh postingan kegiatan terkait juga akan terhapus.')" class="m-0">
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
                            <td colspan="8" class="text-center py-10 text-gray-400 italic">
                                Belum ada data ekstrakurikuler. Silakan klik tombol "Tambah Eskul".
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($eskuls->hasPages())
            <div class="p-4 border-t border-gray-100 flex justify-center">
                {{ $eskuls->links('pagination::bootstrap-4') }}
            </div>
        @endif
    </div>
</div>
@endsection
