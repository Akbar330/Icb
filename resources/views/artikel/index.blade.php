@extends('layouts.main')

@section('title', 'Artikel')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold text-blue-600 text-center">Artikel Terbaru</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-2xl font-semibold text-blue-600">Artikel 1</h3>
                <p class="text-gray-600">Ringkasan artikel mengenai topik pendidikan dan pengembangan diri.</p>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-2xl font-semibold text-blue-600">Artikel 2</h3>
                <p class="text-gray-600">Artikel tentang cara mengembangkan kebiasaan belajar yang efektif.</p>
            </div>
        </div>
    </div>
@endsection
