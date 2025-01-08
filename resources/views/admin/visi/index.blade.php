@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-700">Dashboard Admin</h1>
        <p class="text-lg text-gray-500 mt-2">Kelola Visi Misi dan Tujuan.</p>

        <!-- Dashboard Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <!-- Tambah visi -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                <h2 class="text-xl font-semibold text-gray-700">Tambah Visi Misi</h2>
                <p class="text-gray-600 mt-2">Tambahkan Visi Misi dan Tujuan.</p>
                <a href="{{ route('admin.visi.create') }}" class="mt-4 inline-block bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 hover:bg-blue-700">
                    Tambah Visi Misi
                </a>
            </div>
        </div>

        <!-- Daftar visi -->
        <div class="mt-8">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Daftar Pengumuman</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Loop visi dari database -->
                @foreach($visis as $visi)
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <p class="text-gray-600 mt-2">Visi: {{ $visi->visi }}</p>
                        <p class="text-gray-600 mt-2">Misi: {{ $visi->misi }}</p>
                        <p class="text-gray-600 mt-2">Tujuan: {{ $visi->tujuan }}</p>
                        <div class="mt-4">
                            <a href="{{ route('admin.visi.edit', $visi->id) }}" class="text-blue-500 hover:underline">Edit</a> |
                            <form action="{{ route('admin.visi.destroy', $visi->id) }}" method="POST" class="inline">
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
