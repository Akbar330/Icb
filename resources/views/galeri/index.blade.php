@extends('layouts.main')

@section('title', 'Galeri')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold text-blue-600 text-center">Galeri Sekolah</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="{{ asset('images/galeri1.jpg') }}" alt="Gallery Image" class="w-full h-64 object-cover">
            </div>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="{{ asset('images/galeri2.jpg') }}" alt="Gallery Image" class="w-full h-64 object-cover">
            </div>
        </div>
    </div>
@endsection
