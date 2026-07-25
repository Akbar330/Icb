@extends('layouts.admin')

@section('title', 'Manajemen Sapaan Kepsek')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Sapaan Kepala Sekolah</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola teks sapaan kepala sekolah yang tampil di beranda.</p>
    </div>
    <a href="{{ route('admin.sapa.create') }}" class="inline-flex items-center bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-sm hover:bg-blue-700 hover:shadow-md transition-all">
        <i class="fas fa-plus mr-2"></i> Tambah Sapaan Baru
    </a>
</div>

<!-- Main Card -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <!-- Toolbar -->
    <div class="p-5 border-b border-gray-100 bg-gray-50/50">
        <h2 class="font-semibold text-gray-700">Daftar Sapaan</h2>
    </div>

    <!-- Table Container -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse whitespace-nowrap">
            <thead>
                <tr class="bg-gray-50/80 text-gray-500 text-xs uppercase tracking-wider">
                    <th class="px-6 py-4 font-medium border-b border-gray-100 w-24">Foto</th>
                    <th class="px-6 py-4 font-medium border-b border-gray-100 min-w-[300px]">Teks Sapaan</th>
                    <th class="px-6 py-4 font-medium border-b border-gray-100">Tanggal Dibuat</th>
                    <th class="px-6 py-4 font-medium border-b border-gray-100 text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                @forelse($sapaan as $sapa)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            @if ($sapa->gambar)
                                <img src="{{ asset('storage/' . $sapa->gambar) }}" alt="Foto Kepsek" class="w-12 h-12 rounded-full object-cover border border-gray-200">
                            @else
                                <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 border border-gray-200">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-normal">
                            <p class="text-gray-800 line-clamp-2 leading-relaxed">{{ $sapa->sapaan }}</p>
                        </td>
                        <td class="px-6 py-4 text-gray-500">
                            {{ \Carbon\Carbon::parse($sapa->created_at)->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('admin.sapa.edit', $sapa->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.sapa.destroy', $sapa->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus sapaan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-comment-dots text-4xl text-gray-300 mb-3"></i>
                                <p>Belum ada data sapaan kepala sekolah.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
