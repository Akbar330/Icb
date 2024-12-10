@extends('layouts.main')

@section('title', $berita->judul)

@section('content')
    <div class="container mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <div class="mt-8">
                <a href="{{ route('berita.index') }}" class="text-blue-500 hover:underline">← Kembali ke Daftar Berita</a>
            </div>
            <h1 class="text-4xl font-bold text-blue-600">{{ $berita->judul }}</h1>
            <p class="text-gray-500 text-sm mb-4">Penulis: {{ $berita->penulis }} | Tanggal: {{ $berita->created_at->format('d M Y') }}</p>


            <div class="mt-6 text-gray-700 leading-relaxed">
                {!! $berita->konten !!}
            </div>
        </div>

     
        {{-- <div class="mt-8">
            <a href="/" class="btn btn-primary">← Kembali ke Home</a>
        </div> --}}
    </div>
@endsection
