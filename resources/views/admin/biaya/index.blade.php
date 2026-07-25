@extends('layouts.admin')

@section('title', 'Manajemen Biaya Sekolah')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Biaya Sekolah</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola informasi biaya SPP dan Non-SPP untuk siswa.</p>
    </div>
    <a href="{{ route('admin.biaya.create') }}" class="inline-flex items-center bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-sm hover:bg-blue-700 hover:shadow-md transition-all">
        <i class="fas fa-plus mr-2"></i> Tambah Biaya Baru
    </a>
</div>

@if(session('success'))
    <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg shadow-sm">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-green-500 mr-3"></i>
            <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
        </div>
    </div>
@endif

<!-- Main Card -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <!-- Toolbar -->
    <div class="p-5 border-b border-gray-100 bg-gray-50/50">
        <h2 class="font-semibold text-gray-700">Daftar Biaya Sekolah</h2>
    </div>

    <div class="p-5 bg-gray-50/30">
        <!-- Biaya Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @forelse($biayaSekolah as $biaya)
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md border border-gray-100 overflow-hidden flex flex-col transition-shadow duration-300">
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-4">
                        <h3 class="text-lg font-bold text-white">{{ $biaya->nama_biaya }}</h3>
                    </div>
                    
                    <div class="p-5 flex-1 flex flex-col">
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                                <span class="text-sm text-gray-500"><i class="fas fa-wallet mr-2 text-blue-500"></i> SPP</span>
                                <span class="font-bold text-gray-800">Rp {{ number_format($biaya->jumlah, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                                <span class="text-sm text-gray-500"><i class="fas fa-money-bill-wave mr-2 text-indigo-500"></i> Non-SPP</span>
                                <span class="font-bold text-gray-800">Rp {{ number_format($biaya->jumlah_non, 0, ',', '.') }}</span>
                            </div>
                            <div>
                                <span class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Keterangan</span>
                                <p class="text-sm text-gray-600 leading-relaxed">{{ $biaya->keterangan ?? 'Tidak ada keterangan khusus.' }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-auto pt-4 border-t border-gray-50 flex justify-between items-center gap-2">
                            <a href="{{ route('admin.biaya.edit', $biaya->id) }}" class="flex-1 text-center bg-blue-50 hover:bg-blue-100 text-blue-600 font-medium py-1.5 px-3 rounded-lg text-sm transition-colors">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                            <form action="{{ route('admin.biaya.destroy', $biaya->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data biaya ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full text-center bg-red-50 hover:bg-red-100 text-red-600 font-medium py-1.5 px-3 rounded-lg text-sm transition-colors">
                                    <i class="fas fa-trash-alt mr-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white p-8 rounded-xl border border-dashed border-gray-300 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                        <i class="fas fa-file-invoice-dollar text-2xl text-gray-400"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">Data Biaya Kosong</h3>
                    <p class="text-gray-500">Silakan tambahkan data biaya sekolah baru.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
