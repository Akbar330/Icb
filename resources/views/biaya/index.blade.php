@extends('layouts.main')

@section('title', 'Biaya')

@section('content')
    <div class="container mt-8">
        <h1 class="text-3xl font-bold text-gray-700 text-center">Biaya Sekolah</h1>
        <p class="text-gray-600 text-center mb-6">Detail biaya SPP dan Non-SPP tersedia di sini.</p>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($biayaSekolah as $biaya)
                <div class="bg-white rounded-lg shadow-lg p-4">
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">{{ $biaya->nama_biaya }}</h2>
                    <div class="text-sm text-gray-600">
                        <p class="mb-1"><span class="font-semibold">SPP:</span> Rp{{ number_format($biaya->jumlah, 2, ',', '.') }}</p>
                        <p class="mb-1"><span class="font-semibold">Non-SPP:</span> Rp{{ number_format($biaya->jumlah_non, 2, ',', '.') }}</p>
                        <p><span class="font-semibold">Keterangan:</span> {{ $biaya->keterangan ?? 'Tidak Ada' }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
