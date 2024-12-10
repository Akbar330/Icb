@extends('layouts.admin')

@section('title', 'Daftar Biaya Sekolah')

@section('content')
    <div class="px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-700">Daftar Biaya Sekolah</h1>
        <a href="{{ route('admin.biaya.create') }}" class="mt-4 inline-block bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 hover:bg-blue-700">
            Tambah Biaya Sekolah
        </a>

        @if(session('success'))
            <div class="mt-4 p-4 bg-green-500 text-white rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <table class="mt-6 w-full text-left border-collapse">
            <thead>
                <tr>
                    <th class="border-b px-4 py-2">Nama Biaya</th>
                    <th class="border-b px-4 py-2">SPP</th>
                    <th class="border-b px-4 py-2">Non-SPP</th>
                    <th class="border-b px-4 py-2">Keterangan</th>
                    <th class="border-b px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($biayaSekolah as $biaya)
                    <tr>
                        <td class="border-b px-4 py-2">{{ $biaya->nama_biaya }}</td>
                        <td class="border-b px-4 py-2">{{ number_format($biaya->jumlah, 0, ',', '.') }}</td>
                        <td class="border-b px-4 py-2">{{ number_format($biaya->jumlah_non, 0, ',', '.') }}</td>
                        <td class="border-b px-4 py-2">{{ $biaya->keterangan ?? 'Tidak Ada' }}</td>
                        <td class="border-b px-4 py-2">
                            <a href="{{ route('admin.biaya.edit', $biaya->id) }}" class="text-blue-500 hover:underline">Edit</a> |
                            <form action="{{ route('admin.biaya.destroy', $biaya->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
