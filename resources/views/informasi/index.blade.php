@extends('layouts.main')

@section('title', 'Informasi')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold text-blue-600 text-center">Informasi Terbaru</h1>
        <p class="text-lg text-gray-600 text-center mb-6">Berikut adalah beberapa informasi terbaru yang ada.</p>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-blue-600 mb-4">Daftar Informasi</h2>

            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left text-gray-700">Judul</th>
                        <th class="px-4 py-2 text-left text-gray-700">Deskripsi</th>
                        <th class="px-4 py-2 text-left text-gray-700">Tanggal Informasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($informasi as $item)
                        <tr>
                            <td class="px-4 py-2 font-semibold">
                                <a href="{{ route('informasi.show', $item->id) }}" class="text-blue-600 hover:text-blue-800">{{ $item->judul }}</a>
                            </td>
                            <td class="px-4 py-2">
                                {{ \Illuminate\Support\Str::limit($item->konten, 100) }}
                            </td>
                            <td class="border-b px-4 py-2">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
