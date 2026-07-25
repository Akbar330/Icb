@extends('layouts.main')

@section('title', 'Biaya')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <div class="text-center mb-10">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800">Biaya Sekolah</h1>
            <div class="w-20 h-1.5 bg-blue-600 mx-auto mt-4 rounded-full"></div>
            <p class="text-gray-500 mt-4 text-lg">Rincian biaya pendidikan SPP dan Non-SPP.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
            @forelse($biayaSekolah as $biaya)
                <div class="bg-white rounded-2xl shadow-md hover-card overflow-hidden border border-gray-100 flex flex-col relative">
                    <div class="h-2 w-full bg-blue-600 absolute top-0 left-0"></div>
                    <div class="p-6 flex-grow">
                        <div class="flex justify-between items-start mb-4">
                            <h2 class="text-xl font-bold text-gray-800">{{ $biaya->nama_biaya }}</h2>
                            <div class="bg-blue-100 text-blue-700 p-2 rounded-lg"><i class="fas fa-wallet"></i></div>
                        </div>
                        <div class="space-y-4 text-sm mt-6">
                            <div class="flex justify-between items-end border-b border-gray-50 pb-2">
                                <span class="text-gray-500">Biaya SPP</span>
                                <span class="font-bold text-gray-800 text-lg">Rp{{ number_format($biaya->jumlah, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-end border-b border-gray-50 pb-2">
                                <span class="text-gray-500">Biaya Non-SPP</span>
                                <span class="font-bold text-gray-800 text-lg">Rp{{ number_format($biaya->jumlah_non, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 p-4 border-t border-gray-100 mt-auto">
                        <p class="text-xs text-gray-500 flex items-start">
                            <i class="fas fa-info-circle mt-0.5 mr-2 text-blue-500"></i>
                            <span>{{ $biaya->keterangan ?? 'Tidak ada keterangan tambahan' }}</span>
                        </p>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 bg-gray-50 rounded-xl border border-dashed border-gray-300">
                    <p class="text-gray-500 italic">Data biaya sekolah belum tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
