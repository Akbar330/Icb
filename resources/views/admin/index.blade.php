@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="px-4 py-8 " style="height: 100vh">
        <h1 class="text-3xl font-bold text-gray-700">Dashboard Admin</h1>
        <p class="text-lg text-gray-500 mt-4">Selamat datang di dashboard admin! Anda dapat mengelola artikel, berita, pengumuman, dan konten lainnya untuk website sekolah Anda melalui menu navigasi di atas.</p>

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <h2 class="text-xl font-semibold text-gray-700">Total Artikel</h2>
                <p class="text-3xl font-bold text-blue-600 mt-4">{{ $totalArtikels ?? 0 }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <h2 class="text-xl font-semibold text-gray-700">Total Berita</h2>
                <p class="text-3xl font-bold text-green-600 mt-4">{{ $totalBeritas ?? 0 }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <h2 class="text-xl font-semibold text-gray-700">Total Pengumuman</h2>
                <p class="text-3xl font-bold text-red-600 mt-4">{{ $totalInformasis ?? 0 }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <h2 class="text-xl font-semibold text-gray-700">Total Kunjungan</h2>
                <p class="text-3xl font-bold text-purple-600 mt-4">{{ $totalVisits ?? 0 }}</p>
            </div>

        </div>
    </div>
@endsection
