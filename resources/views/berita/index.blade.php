@extends('layouts.main')

@section('title', 'Berita')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold text-blue-600 text-center">Berita Sekolah</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-2xl font-semibold text-blue-600">Berita 1</h3>
                <p class="text-gray-600">Ringkasan berita terbaru dari sekolah kami.</p>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-2xl font-semibold text-blue-600">Berita 2</h3>
                <p class="text-gray-600">Berita lainnya yang tak kalah penting.</p>
            </div>
        </div>
    </div>
@endsection