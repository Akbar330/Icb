@extends('layouts.main')

@section('title', 'Biaya')

@section('content')
    <div class="container mt-8">
        <h1 class="text-3xl font-bold text-gray-700">Tabel Biaya Sekolah</h1>
        <table class="min-w-full mt-4 table-auto border-collapse border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border border-gray-300 text-left">Nama Biaya</th>
                    <th class="py-2 px-4 border border-gray-300 text-left">SPP</th>
                    <th class="py-2 px-4 border border-gray-300 text-left">Non-SPP</th>
                    <th class="py-2 px-4 border border-gray-300 text-left">Tanggal Dibuat</th>
                    <th class="py-2 px-4 border border-gray-300 text-left">Tanggal Diperbarui</th>
                </tr>
            </thead>
            <tbody>
                @foreach($biayaSekolah as $biaya)
                    <tr>
                        <td class="py-2 px-4 border border-gray-300">{{ $biaya->nama_biaya }}</td>
                        <td class="py-2 px-4 border border-gray-300">{{ number_format($biaya->jumlah, 2, ',', '.') }}</td>
                        <td class="py-2 px-4 border border-gray-300">{{ number_format($biaya->jumlah_non, 2, ',', '.') }}</td>
                        <td class="py-2 px-4 border border-gray-300">{{ $biaya->created_at->format('d M Y') }}</td>
                        <td class="py-2 px-4 border border-gray-300">{{ $biaya->updated_at->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
