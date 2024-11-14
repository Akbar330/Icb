@extends('layouts.admin')

@section('title', 'Detail Pendaftar')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold text-blue-600 text-center mb-6">Detail Pendaftar</h1>

        <!-- Tombol Kembali -->
        <div class="mb-4">
            <a href="{{ route('admin.pendaftaran.index') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">
                Kembali ke Daftar
            </a>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-blue-600 mb-4">Informasi Pendaftar</h2>

            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <tbody>
                    <tr>
                        <td class="px-4 py-2 font-semibold">Nama Siswa</td>
                        <td class="px-4 py-2">{{ $pendaftaran->nama_siswa }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-semibold">Alamat</td>
                        <td class="px-4 py-2">{{ $pendaftaran->alamat }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-semibold">Tanggal Lahir</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($pendaftaran->ttl)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-semibold">Jenis Kelamin</td>
                        <td class="px-4 py-2">{{ $pendaftaran->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-semibold">Email</td>
                        <td class="px-4 py-2">{{ $pendaftaran->email }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-semibold">Jalur Pendaftaran</td>
                        <td class="px-4 py-2">{{ $pendaftaran->jalur_pendaftaran }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-semibold">Jurusan</td>
                        <td class="px-4 py-2">{{ $pendaftaran->jurusan }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-semibold">No HP</td>
                        <td class="px-4 py-2">{{ $pendaftaran->no_hp }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-semibold">Nama Orang Tua/Wali</td>
                        <td class="px-4 py-2">{{ $pendaftaran->nama_ortu_wali }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-semibold">Alamat Wali</td>
                        <td class="px-4 py-2">{{ $pendaftaran->alamat_wali }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-semibold">Pekerjaan Wali</td>
                        <td class="px-4 py-2">{{ $pendaftaran->pekerjaan_wali }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-semibold">No HP Wali</td>
                        <td class="px-4 py-2">{{ $pendaftaran->no_hp_wali }}</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 font-semibold">ABK</td>
                        <td class="px-4 py-2">{{ $pendaftaran->abk }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
