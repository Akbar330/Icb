@extends('layouts.main')

@section('title', 'Data Sekolah')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold text-blue-600 text-center">Data Sekolah</h1>
        <p class="text-lg text-gray-600 text-center mb-6">Data penting yang terkait dengan sekolah, tersedia di sini.</p>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-blue-600 mb-4">Informasi Sekolah</h2>

            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left text-gray-700">Informasi</th>
                        <th class="px-4 py-2 text-left text-gray-700">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-4 py-2 font-semibold">NPSN</td>
                        <td class="px-4 py-2">20219292</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-semibold">Status</td>
                        <td class="px-4 py-2">Swasta</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-semibold">Bentuk Pendidikan</td>
                        <td class="px-4 py-2">SMK</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-semibold">Status Kepemilikan</td>
                        <td class="px-4 py-2">Yayasan</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-semibold">SK Pendirian Sekolah</td>
                        <td class="px-4 py-2">417/I02/Kep/E.91</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-semibold">Tanggal SK Pendirian</td>
                        <td class="px-4 py-2">1991-08-14</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-semibold">SK Izin Operasional</td>
                        <td class="px-4 py-2">417/I02/Kep/E.91</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-semibold">Tanggal SK Izin Operasional</td>
                        <td class="px-4 py-2">1991-08-14</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-semibold">Alamat</td>
                        <td class="px-4 py-2">Jalan Atlas Tengah No.2, Bandung, Indonesia</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
