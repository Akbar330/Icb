@extends('layouts.admin')

@section('title', 'Dashboard Admin - Oncam')

@section('content')
    <div class="px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-700">Dashboard Admin - Oncam</h1>
        <p class="text-lg text-gray-500 mt-2">Kelola daftar link Oncam di sistem Anda.</p>

        <!-- Dashboard Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <!-- Tambah Oncam -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                <h2 class="text-xl font-semibold text-gray-700">Tambah Oncam</h2>
                <p class="text-gray-600 mt-2">Tambahkan link Oncam baru untuk ditampilkan pada halaman utama.</p>
                <a href="{{ route('oncam.create') }}" class="mt-4 inline-block bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 hover:bg-blue-700">
                    Tambah Oncam
                </a>
            </div>
        </div>

        <!-- Daftar Oncam -->
        <div class="mt-8">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Daftar Link Oncam</h2>



            <!-- Daftar Oncam -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-700">Oncam</h3>
                <table class="w-full mt-4 text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="border-b px-4 py-2">ID</th>
                            <th class="border-b px-4 py-2">Embed Link</th>
                            <th class="border-b px-4 py-2">Tanggal</th>
                            <th class="border-b px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="oncamTable">
                        @foreach($oncams as $oncam)
                            <tr>
                                <td class="border-b px-4 py-2">{{ $oncam->id }}</td>
                                <td class="border-b px-4 py-2">
                                    <a href="{{ $oncam->embed_link }}" target="_blank" class="text-blue-600 hover:underline">
                                        {{ $oncam->embed_link }}
                                    </a>
                                </td>
                                <td class="border-b px-4 py-2">{{ $oncam->created_at->format('d M Y') }}</td>
                                <td class="border-b px-4 py-2">
                                    <a href="{{ route('oncam.edit', $oncam->id) }}" class="text-blue-500 hover:underline">Edit</a> |
                                    <form action="{{ route('oncam.destroy', $oncam->id) }}" method="POST" class="inline">
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

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
