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
    <div class="mt-8">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Daftar Carousel</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Looping daftar carousel dari database -->
            @foreach($carousels as $carousel)
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center justify-center mb-4">
                        <img src="{{ asset('storage/' . $carousel->image_path) }}" alt="Carousel Image" class="w-full h-48 object-cover rounded-lg">
                    </div>
                    <h3 class="text-xl font-semibold text-gray-700">Urutan: {{ $carousel->order }}</h3>
                    <div class="mt-4 flex justify-between">
                        <a href="{{ route('admin.carousel.edit', $carousel->id) }}" class="text-blue-500 hover:underline">Edit</a> |
                        <form action="{{ route('admin.carousel.destroy', $carousel->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
