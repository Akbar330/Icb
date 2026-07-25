@extends('layouts.main')

@section('title', 'Visi, Misi, dan Tujuan')

@section('content')
    <div class="container mx-auto px-4 md:px-8 py-12">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 leading-tight mb-4">
                Visi, Misi, dan Tujuan
            </h1>
            <div class="w-20 h-1.5 bg-blue-600 mx-auto rounded-full mb-6"></div>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Pedoman kami dalam menciptakan pendidikan berkualitas di bidang teknologi, guna menghasilkan lulusan yang siap bersaing dan berkontribusi di dunia industri.
            </p>
        </div>

        @if ($visiMisi)
            <div class="max-w-4xl mx-auto space-y-8">
                <!-- Visi Card -->
                <div class="bg-white p-8 md:p-10 rounded-2xl shadow-lg border-t-4 border-blue-600 hover-card relative overflow-hidden">
                    <div class="absolute -right-6 -top-6 text-blue-50 opacity-50 text-9xl font-bold z-0"><i class="fas fa-eye"></i></div>
                    <div class="relative z-10 text-center">
                        <h2 class="text-3xl font-bold text-blue-700 mb-6 inline-block pb-2 border-b-2 border-blue-200 uppercase tracking-widest">Visi</h2>
                        <div class="text-gray-700 text-lg md:text-xl leading-relaxed italic font-medium">
                            {!! htmlspecialchars_decode($visiMisi->visi) !!}
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Misi Card -->
                    <div class="bg-white p-8 rounded-2xl shadow-md border border-gray-100 hover-card">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xl mr-4">
                                <i class="fas fa-rocket"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800">Misi Kami</h2>
                        </div>
                        <div class="text-gray-600 leading-relaxed space-y-2 prose prose-blue max-w-none">
                            {!! htmlspecialchars_decode($visiMisi->misi) !!}
                        </div>
                    </div>

                    <!-- Tujuan Card -->
                    <div class="bg-white p-8 rounded-2xl shadow-md border border-gray-100 hover-card">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xl mr-4">
                                <i class="fas fa-bullseye"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800">Tujuan</h2>
                        </div>
                        <div class="text-gray-600 leading-relaxed space-y-2 prose prose-blue max-w-none">
                            {!! htmlspecialchars_decode($visiMisi->tujuan) !!}
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="max-w-2xl mx-auto text-center py-12 bg-red-50 rounded-xl border border-dashed border-red-200">
                <i class="fas fa-exclamation-triangle text-4xl text-red-400 mb-4"></i>
                <p class="text-lg text-red-600 font-medium">Data Visi, Misi, dan Tujuan belum tersedia.</p>
            </div>
        @endif
    </div>
@endsection
