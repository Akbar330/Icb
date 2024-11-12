@extends('layouts.main')

@section('title', 'Visi-Misi')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-blue-600">Visi dan Misi Sekolah</h1>
            <p class="text-lg text-gray-600">Visi dan Misi yang menjadi pedoman kami dalam menciptakan pendidikan berkualitas.</p>
        </div>

        <!-- Visi Section -->
        <section id="visi" class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <div class="flex items-center p-6">
                <div class="w-1/2">
                    <h2 class="text-2xl font-semibold text-blue-600 mb-4">Visi Sekolah</h2>
                    <p class="text-lg text-gray-600">Menjadi lembaga pendidikan yang unggul dalam membentuk karakter dan keterampilan siswa untuk masa depan yang lebih baik.</p>
                </div>
                <div class="w-1/2">
                    <img src="{{ asset('images/visi.jpg') }}" alt="Visi Image" class="w-full rounded-lg shadow-md">
                </div>
            </div>
        </section>

        <!-- Misi Section -->
        <section id="misi" class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="flex items-center p-6">
                <div class="w-1/2">
                    <h2 class="text-2xl font-semibold text-blue-600 mb-4">Misi Sekolah</h2>
                    <ul class="list-disc pl-6 text-lg text-gray-600 space-y-3">
                        <li>Menyediakan pendidikan yang berkualitas dengan pendekatan inovatif.</li>
                        <li>Mengembangkan karakter siswa melalui kegiatan ekstrakurikuler yang bermakna.</li>
                        <li>Mengoptimalkan teknologi dalam mendukung proses pembelajaran.</li>
                    </ul>
                </div>
                <div class="w-1/2">
                    <img src="{{ asset('images/misi.jpg') }}" alt="Misi Image" class="w-full rounded-lg shadow-md">
                </div>
            </div>
        </section>
    </div>
@endsection
