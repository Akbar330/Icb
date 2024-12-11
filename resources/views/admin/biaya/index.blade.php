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

        <!-- Card Layout for Biaya Sekolah -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            @foreach($biayaSekolah as $biaya)
                <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-800">{{ $biaya->nama_biaya }}</h3>
                    <p class="mt-2 text-gray-600">SPP: {{ number_format($biaya->jumlah, 0, ',', '.') }}</p>
                    <p class="mt-2 text-gray-600">Non-SPP: {{ number_format($biaya->jumlah_non, 0, ',', '.') }}</p>
                    <p class="mt-2 text-gray-600">Keterangan: {{ $biaya->keterangan ?? 'Tidak Ada' }}</p>

                    <div class="mt-4 flex justify-between">
                        <a href="{{ route('admin.biaya.edit', $biaya->id) }}" class="text-blue-500 hover:underline">Edit</a>
                        <form action="{{ route('admin.biaya.destroy', $biaya->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
