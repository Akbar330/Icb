@extends('layouts.main')

@section('title', 'Data Sekolah')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <div class="text-center mb-10">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800">Data Sekolah</h1>
            <div class="w-20 h-1.5 bg-blue-600 mx-auto mt-4 rounded-full"></div>
            <p class="text-gray-500 mt-4 text-lg">Informasi resmi dan data penting terkait profil sekolah.</p>
        </div>

        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover-card">
            <div class="bg-blue-600 px-6 py-4 border-b border-blue-700">
                <h2 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-info-circle mr-3"></i> Informasi Profil
                </h2>
            </div>
            
            <div class="p-6 md:p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                    <div class="bg-gray-50 p-4 md:p-5 rounded-xl border border-gray-100 overflow-hidden">
                        <p class="text-xs font-bold text-blue-500 uppercase tracking-wider mb-1">NPSN</p>
                        <p class="text-gray-800 font-semibold text-base md:text-lg break-words">20219292</p>
                    </div>
                    <div class="bg-gray-50 p-4 md:p-5 rounded-xl border border-gray-100 overflow-hidden">
                        <p class="text-xs font-bold text-blue-500 uppercase tracking-wider mb-1">Status</p>
                        <p class="text-gray-800 font-semibold text-base md:text-lg break-words">Swasta</p>
                    </div>
                    <div class="bg-gray-50 p-4 md:p-5 rounded-xl border border-gray-100 overflow-hidden">
                        <p class="text-xs font-bold text-blue-500 uppercase tracking-wider mb-1">Bentuk Pendidikan</p>
                        <p class="text-gray-800 font-semibold text-base md:text-lg break-words">SMK</p>
                    </div>
                    <div class="bg-gray-50 p-4 md:p-5 rounded-xl border border-gray-100 overflow-hidden">
                        <p class="text-xs font-bold text-blue-500 uppercase tracking-wider mb-1">Status Kepemilikan</p>
                        <p class="text-gray-800 font-semibold text-base md:text-lg break-words">Yayasan</p>
                    </div>
                    <div class="bg-gray-50 p-4 md:p-5 rounded-xl border border-gray-100 overflow-hidden">
                        <p class="text-xs font-bold text-blue-500 uppercase tracking-wider mb-1">SK Pendirian Sekolah</p>
                        <p class="text-gray-800 font-semibold text-base md:text-lg break-words">417/I02/Kep/E.91</p>
                    </div>
                    <div class="bg-gray-50 p-4 md:p-5 rounded-xl border border-gray-100 overflow-hidden">
                        <p class="text-xs font-bold text-blue-500 uppercase tracking-wider mb-1">Tanggal SK Pendirian</p>
                        <p class="text-gray-800 font-semibold text-base md:text-lg break-words">1991-08-14</p>
                    </div>
                    <div class="bg-gray-50 p-4 md:p-5 rounded-xl border border-gray-100 overflow-hidden">
                        <p class="text-xs font-bold text-blue-500 uppercase tracking-wider mb-1">SK Izin Operasional</p>
                        <p class="text-gray-800 font-semibold text-base md:text-lg break-words">417/I02/Kep/E.91</p>
                    </div>
                    <div class="bg-gray-50 p-4 md:p-5 rounded-xl border border-gray-100 overflow-hidden">
                        <p class="text-xs font-bold text-blue-500 uppercase tracking-wider mb-1">Tanggal SK Izin Operasional</p>
                        <p class="text-gray-800 font-semibold text-base md:text-lg break-words">1991-08-14</p>
                    </div>
                    <div class="bg-gray-50 p-4 md:p-5 rounded-xl border border-gray-100 md:col-span-2 overflow-hidden">
                        <p class="text-xs font-bold text-blue-500 uppercase tracking-wider mb-1">Alamat</p>
                        <p class="text-gray-800 font-semibold text-sm md:text-lg leading-relaxed break-words">Jalan Atlas Tengah No.2, Babakan Surabaya, Kec. Kiaracondong, Kota Bandung, Jawa Barat 40281</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
