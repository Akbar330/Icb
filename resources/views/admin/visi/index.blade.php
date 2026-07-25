@extends('layouts.admin')

@section('title', 'Manajemen Visi & Misi')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Visi Misi</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola data visi, misi, dan tujuan sekolah yang tampil di website.</p>
    </div>
    @if($visis->count() == 0)
    <a href="{{ route('admin.visi.create') }}" class="inline-flex items-center bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-sm hover:bg-blue-700 hover:shadow-md transition-all">
        <i class="fas fa-plus mr-2"></i> Tambah Visi Misi
    </a>
    @endif
</div>

<!-- Main Card -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <!-- Toolbar -->
    <div class="p-5 border-b border-gray-100 bg-gray-50/50">
        <h2 class="font-semibold text-gray-700">Data Visi Misi & Tujuan Sekolah</h2>
    </div>

    <div class="p-5 bg-gray-50/30">
        <div class="grid grid-cols-1 gap-6">
            @forelse($visis as $visi)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="grid grid-cols-1 lg:grid-cols-3 divide-y lg:divide-y-0 lg:divide-x divide-gray-100">
                        <!-- Visi -->
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mr-3">
                                    <i class="fas fa-eye"></i>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800">Visi</h3>
                            </div>
                            <div class="prose prose-sm max-w-none text-gray-600">
                                {!! htmlspecialchars_decode($visi->visi) !!}
                            </div>
                        </div>
                        
                        <!-- Misi -->
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center mr-3">
                                    <i class="fas fa-bullseye"></i>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800">Misi</h3>
                            </div>
                            <div class="prose prose-sm max-w-none text-gray-600">
                                {!! htmlspecialchars_decode($visi->misi) !!}
                            </div>
                        </div>
                        
                        <!-- Tujuan -->
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center mr-3">
                                    <i class="fas fa-flag-checkered"></i>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800">Tujuan</h3>
                            </div>
                            <div class="prose prose-sm max-w-none text-gray-600">
                                {!! htmlspecialchars_decode($visi->tujuan) !!}
                            </div>
                        </div>
                    </div>
                    
                    <!-- Actions -->
                    <div class="bg-gray-50 p-4 border-t border-gray-100 flex justify-end gap-2">
                        <a href="{{ route('admin.visi.edit', $visi->id) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-blue-600 transition-colors shadow-sm">
                            <i class="fas fa-edit mr-2"></i> Edit Data
                        </a>
                        <form action="{{ route('admin.visi.destroy', $visi->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data Visi Misi ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-50 border border-red-200 rounded-lg text-sm font-medium text-red-600 hover:bg-red-100 transition-colors shadow-sm">
                                <i class="fas fa-trash-alt mr-2"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-white p-10 rounded-xl border border-dashed border-gray-300 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gray-100 mb-4">
                        <i class="fas fa-university text-4xl text-gray-400"></i>
                    </div>
                    <h3 class="text-xl font-medium text-gray-900 mb-2">Data Visi Misi Belum Diisi</h3>
                    <p class="text-gray-500 max-w-md mx-auto mb-6">Tambahkan visi, misi, dan tujuan sekolah Anda untuk ditampilkan di halaman profil website.</p>
                    <a href="{{ route('admin.visi.create') }}" class="inline-flex items-center bg-blue-600 text-white font-semibold py-2.5 px-6 rounded-lg shadow-sm hover:bg-blue-700 hover:shadow-md transition-all">
                        <i class="fas fa-plus mr-2"></i> Tambah Visi Misi Sekarang
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
