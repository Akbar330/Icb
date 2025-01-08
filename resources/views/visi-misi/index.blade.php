@extends('layouts.main')

@section('title', 'Visi, Misi, dan Tujuan')

@section('content')
    <div class="container mx-auto px-4 md:px-8 py-12">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-blue-700 leading-tight mb-4">
                Visi, Misi, dan Tujuan SMK ICB Cinta Teknika Bandung
            </h1>
            <p class="text-lg text-gray-700 max-w-2xl mx-auto">
                Visi, Misi, dan Tujuan yang menjadi pedoman kami dalam menciptakan pendidikan berkualitas di bidang teknologi, guna menghasilkan lulusan yang siap bersaing dan berkontribusi di dunia industri.
            </p>
        </div>

        @if ($visiMisi)
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="text-gray-600 mt-2">
                    <strong>Visi:</strong> {!! htmlspecialchars_decode($visiMisi->visi) !!}
                </div>
                <div class="text-gray-600 mt-2">
                    <strong>Misi:</strong> {!! htmlspecialchars_decode($visiMisi->misi) !!}
                </div>
                <div class="text-gray-600 mt-2">
                    <strong>Tujuan:</strong> {!! htmlspecialchars_decode($visiMisi->tujuan) !!}
                </div>
            </div>
        @else
            <p class="text-center text-red-500">Data Visi, Misi, dan Tujuan tidak tersedia.</p>
        @endif
    </div>
@endsection
