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
            <!-- Visi Section -->
            <section id="visiMisi" class="bg-gradient-to-r from-blue-100 to-blue-50 rounded-lg shadow-lg overflow-hidden mb-10 p-8">
                <div class="flex flex-col md:flex-row items-center space-y-6 md:space-y-0 md:space-x-8">
                    <div class="w-full md:w-1/2">
                        <h2 class="text-2xl md:text-3xl font-semibold text-blue-600 mb-6">Visi</h2>
                        <div class="w-full md:w-1/2 mb-5">
                            <img src="{{ asset('visiMisi.jpeg') }}" alt="Visi Image"
                                 class="w-full h-64 object-cover rounded-lg shadow-xl hover:scale-105 transform transition duration-300">
                        </div>
                        <p class="text-lg text-gray-700 leading-relaxed">
                            {{ $visiMisi->visi }}
                        </p>
                    </div>
                </div>
            </section>

            <!-- Misi Section -->
            <section id="misi" class="bg-gradient-to-r from-green-100 to-green-50 rounded-lg shadow-lg overflow-hidden mb-10 p-8">
                <div class="flex flex-col md:flex-row items-center space-y-6 md:space-y-0 md:space-x-8">
                    <div class="w-full md:w-1/2">
                        <h2 class="text-2xl md:text-3xl font-semibold text-green-600 mb-6">Misi</h2>
                        <div class="w-full md:w-1/2 mb-5">
                            <img src="{{ asset('misi.jpeg') }}" alt="Misi Image"
                                 class="w-full h-64 object-cover rounded-lg shadow-xl hover:scale-105 transform transition duration-300">
                        </div>
                        <p class="text-lg text-gray-700 leading-relaxed">
                            {!! nl2br(e($visiMisi->misi)) !!}
                        </p>
                    </div>
                </div>
            </section>

            <!-- Tujuan Section -->
            <section id="tujuan" class="bg-gradient-to-r from-purple-100 to-purple-50 rounded-lg shadow-lg overflow-hidden p-8">
                <div class="flex flex-col md:flex-row items-center space-y-6 md:space-y-0 md:space-x-8">
                    <div class="w-full md:w-1/2">
                        <h2 class="text-2xl md:text-3xl font-semibold text-purple-600 mb-6">Tujuan</h2>
                        <div class="w-full md:w-1/2 mb-5">
                            <img src="{{ asset('tujuan.jpeg') }}" alt="Tujuan Image"
                                 class="w-full h-64 object-cover rounded-lg shadow-xl hover:scale-105 transform transition duration-300">
                        </div>
                        <p class="text-lg text-gray-700 leading-relaxed">
                            {!! nl2br(e($visiMisi->tujuan)) !!}
                        </p>
                    </div>
                </div>
            </section>
        @else
            <p class="text-center text-red-500">Data Visi, Misi, dan Tujuan tidak tersedia.</p>
        @endif
    </div>
@endsection
