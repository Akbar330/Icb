@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-700">Dashboard Admin</h1>
        <p class="text-lg text-gray-500 mt-2">Kelola Sapaan Kepala Sekolah</p>

        <!-- Dashboard Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <!-- Tambah sapa -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                <h2 class="text-xl font-semibold text-gray-700">Tambah Sapaan</h2>
                <p class="text-gray-600 mt-2">Buat Sapaan kepada pengunjung.</p>
                <a href="{{ route('admin.sapa.create') }}" class="mt-4 inline-block bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 hover:bg-blue-700">
                    Tambah Sapaan
                </a>
            </div>

        </div>

        <!-- Daftar sapa dan Berita -->
        <div class="mt-8">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Daftar Sapaan</h2>

    <!-- Daftar sapa -->
    <div class="bg-white p-6 rounded-lg shadow-md"> 
        <table class="w-full mt-4 text-left border-collapse">
            <thead>
                <tr>
                    <th class="border-b px-4 py-2">gambar</th>
                    <th class="border-b px-4 py-2">Sapaan</th>
                    <th class="border-b px-4 py-2">tanggal dibuat</th>
                    <th class="border-b px-4 py-2">aksi</th>
                </tr>
            </thead>
            <tbody id="sapaTable">
                <!-- Loop berita dari database -->
                @foreach($sapaan as $sapa)
                    <tr>
                        <td class="border-b px-4 py-2">@if ($sapa->gambar)
                            <img src="{{ asset('storage/' . $sapa->gambar) }}"
                                alt="Gambar sapa" width="100">
                        @else
                            Tidak ada gambar
                        @endif</td>
                        <td class="border-b px-4 py-2">{{ $sapa->sapaan}}</td>
                        <td class="border-b px-4 py-2">{{ \Carbon\Carbon::parse($sapa->created_at)->format('d-m-Y') }}</td>
                        <td class="border-b px-4 py-2">
                            <a href="{{ route('admin.sapa.edit', $sapa->id) }}" class="text-blue-500 hover:underline">Edit</a> |
                            <form action="{{ route('admin.sapa.destroy', $sapa->id) }}" method="POST" class="inline">
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
</div>

</div>

@endsection
