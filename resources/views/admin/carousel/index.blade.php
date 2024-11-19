@extends('layouts.admin')

@section('title', 'Carousel List')

@section('content')
<div class="px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-700">Daftar Carousel</h1>
    <p class="text-lg text-gray-500 mt-2">Kelola carousel yang ditampilkan di halaman utama.</p>

    <!-- Card untuk tombol tambah carousel -->
    <div class="mt-8">
        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
            <h2 class="text-xl font-semibold text-gray-700">Tambah Carousel</h2>
            <p class="text-gray-600 mt-2">Klik tombol di bawah ini untuk menambah carousel baru.</p>
            <a href="{{ route('admin.carousel.create') }}" class="mt-4 inline-block bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 hover:bg-blue-700">
                Tambah Carousel Baru
            </a>
        </div>
    </div>


    <!-- Daftar Carousel -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Daftar Carousel</h2>

        <table class="w-full text-left border-collapse">
            <thead>
                <tr>
                    <th class="border-b px-4 py-2">Urutan</th>
                    <th class="border-b px-4 py-2">Gambar</th>
                    <th class="border-b px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Looping daftar carousel dari database -->
                @foreach($carousels as $carousel)
                    <tr>
                        <td class="border-b px-4 py-2">{{ $carousel->order }}</td>
                        <td class="border-b px-4 py-2">
                                <img src="{{ asset('storage/' . $carousel->image_path) }}" alt="Carousel Image" class="w-20 h-20 object-cover rounded">
                        </td>
                        <td class="border-b px-4 py-2">
                            <!-- Aksi Edit dan Hapus -->
                            <a href="{{ route('admin.carousel.edit', $carousel->id) }}" class="text-blue-500 hover:underline">Edit</a> |
                            <form action="{{ route('admin.carousel.destroy', $carousel->id) }}" method="POST" class="inline">
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
@endsection
