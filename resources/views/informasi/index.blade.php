@extends('layouts.main')

@section('title', 'Informasi')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold text-blue-600 text-center">Informasi Terbaru</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-2xl font-semibold text-blue-600">Informasi 1</h3>
                <p class="text-gray-600">Deskripsi informasi yang sangat berguna untuk warga sekolah.</p>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-2xl font-semibold text-blue-600">Informasi 2</h3>
                <p class="text-gray-600">Deskripsi informasi lainnya yang perlu diketahui.</p>
            </div>
        </div>
    </div>
@endsection
