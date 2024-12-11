@extends('layouts.main')

@section('title', 'Data Sekolah')

@section('content')
<div class="container mx-auto px-4 py-12">
    <h1 class="text-3xl md:text-4xl font-bold text-blue-600 text-center">Data Sekolah</h1>
    <p class="text-base md:text-lg text-gray-600 text-center mb-6">
        Data penting yang terkait dengan sekolah, tersedia di sini.
    </p>

        <h2 class="text-xl md:text-2xl font-semibold text-blue-600 mb-4">Informasi Sekolah</h2>

        <div class="grid gap-2 sm:grid-cols-1 lg:grid-cols-2">
            <!-- Item -->
            <div class="flex flex-col bg-gray-100 p-4 rounded-lg shadow w-full">
                <span class="font-semibold text-gray-700 text-base truncate">NPSN</span>
                <span class="text-gray-600 text-sm md:text-base">20219292</span>
            </div>
            <div class="flex flex-col bg-gray-100 p-4 rounded-lg shadow w-full">
                <span class="font-semibold text-gray-700 text-base truncate">Status</span>
                <span class="text-gray-600 text-sm md:text-base">Swasta</span>
            </div>
            <div class="flex flex-col bg-gray-100 p-4 rounded-lg shadow w-full">
                <span class="font-semibold text-gray-700 text-base truncate">Bentuk Pendidikan</span>
                <span class="text-gray-600 text-sm md:text-base">SMK</span>
            </div>
            <div class="flex flex-col bg-gray-100 p-4 rounded-lg shadow w-full">
                <span class="font-semibold text-gray-700 text-base truncate">Status Kepemilikan</span>
                <span class="text-gray-600 text-sm md:text-base">Yayasan</span>
            </div>
            <div class="flex flex-col bg-gray-100 p-4 rounded-lg shadow w-full">
                <span class="font-semibold text-gray-700 text-base truncate">SK Pendirian Sekolah</span>
                <span class="text-gray-600 text-sm md:text-base">417/I02/Kep/E.91</span>
            </div>
            <div class="flex flex-col bg-gray-100 p-4 rounded-lg shadow w-full">
                <span class="font-semibold text-gray-700 text-base truncate">Tanggal SK Pendirian</span>
                <span class="text-gray-600 text-sm md:text-base">1991-08-14</span>
            </div>
            <div class="flex flex-col bg-gray-100 p-4 rounded-lg shadow w-full">
                <span class="font-semibold text-gray-700 text-base truncate">SK Izin Operasional</span>
                <span class="text-gray-600 text-sm md:text-base">417/I02/Kep/E.91</span>
            </div>
            <div class="flex flex-col bg-gray-100 p-4 rounded-lg shadow w-full">
                <span class="font-semibold text-gray-700 text-base truncate">Tanggal SK Izin Operasional</span>
                <span class="text-gray-600 text-sm md:text-base">1991-08-14</span>
            </div>
            <div class="flex flex-col bg-gray-100 p-4 rounded-lg shadow w-full">
                <span class="font-semibold text-gray-700 text-base truncate">Alamat</span>
                <span class="text-gray-600 text-sm md:text-base">Jalan Atlas Tengah No.2, Bandung, Indonesia</span>
            </div>
        </div>
    </div>


</div>
@endsection
