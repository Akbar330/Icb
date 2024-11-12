@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-700">Dashboard Admin</h1>
        <p class="text-lg text-gray-500 mt-2">Kelola Artikel dan Berita di Sekolah Anda</p>

        <!-- Dashboard Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <!-- Tambah Artikel -->

            <!-- Tambah Berita -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                <h2 class="text-xl font-semibold text-gray-700">Tambah Berita</h2>
                <p class="text-gray-600 mt-2">Publikasikan berita terbaru terkait kegiatan dan informasi sekolah.</p>
                <a href="{{ route('admin.berita.create') }}" class="mt-4 inline-block bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 hover:bg-blue-700">
                    Tambah Berita
                </a>
            </div>
        </div>

        <!-- Daftar Artikel dan Berita -->
        <div class="mt-8">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Daftar Berita</h2>

            <!-- Daftar Berita -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-700">Berita</h3>
                <table class="w-full mt-4 text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="border-b px-4 py-2">Judul</th>
                            <th class="border-b px-4 py-2">Penulis</th>
                            <th class="border-b px-4 py-2">Tanggal</th>
                            <th class="border-b px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loop berita dari database -->
                        @foreach($beritas as $berita)
                            <tr>
                                <td class="border-b px-4 py-2">{{ $berita->judul }}</td>
                                <td class="border-b px-4 py-2">{{ $berita->penulis }}</td>
                                <td class="border-b px-4 py-2">{{ $berita->created_at->format('d M Y') }}</td>
                                <td class="border-b px-4 py-2">
                                    <a href="{{ route('admin.berita.edit', $berita->id) }}" class="text-blue-500 hover:underline">Edit</a> |
                                    <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" class="inline">
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
