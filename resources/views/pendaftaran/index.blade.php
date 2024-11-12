@extends('layouts.main')

@section('title', 'Pendaftaran')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold text-blue-600 text-center">Pendaftaran Siswa Baru</h1>
        <p class="text-lg text-gray-600 text-center">Langkah-langkah untuk melakukan pendaftaran siswa baru di sekolah kami.</p>
        <a href="/pendaftaran-form" class="inline-block bg-blue-500 text-white font-bold py-3 px-6 rounded-lg">Daftar Sekarang</a>
    </div>
@endsection
