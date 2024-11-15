@extends('layouts.admin')

@section('title', 'Data Pendaftar')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold text-blue-600 text-center">Data Pendaftar</h1>
        <p class="text-lg text-gray-600 text-center mb-6">Berikut adalah data pendaftar yang telah melakukan registrasi.</p>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-blue-600 mb-4">Informasi Pendaftar</h2>

            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left text-gray-700">Nama Siswa</th>
                        <th class="px-4 py-2 text-left text-gray-700">Alamat</th>
                        <th class="px-4 py-2 text-left text-gray-700">TTL</th>
                        <th class="px-4 py-2 text-left text-gray-700">Jenis Kelamin</th>
                        <th class="px-4 py-2 text-left text-gray-700">Email</th>
                        <th class="px-4 py-2 text-left text-gray-700">Jalur Pendaftaran</th>
                        <th class="px-4 py-2 text-left text-gray-700">Jurusan</th>
                        <th class="px-4 py-2 text-left text-gray-700">No HP</th>
                        <th class="px-4 py-2 text-left text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pendaftarans as $pendaftaran)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $pendaftaran->nama_siswa }}</td>
                            <td class="px-4 py-2">{{ $pendaftaran->alamat }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($pendaftaran->ttl)->format('d-m-Y') }}</td>
                            <td class="px-4 py-2">{{ $pendaftaran->jenis_kelamin }}</td>
                            <td class="px-4 py-2">{{ $pendaftaran->email }}</td>
                            <td class="px-4 py-2">{{ $pendaftaran->jalur_pendaftaran }}</td>
                            <td class="px-4 py-2">{{ $pendaftaran->jurusan }}</td>
                            <td class="px-4 py-2">{{ $pendaftaran->no_hp }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('admin.pendaftaran.show', $pendaftaran->id) }}" class="text-blue-600 hover:underline">Lihat</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
