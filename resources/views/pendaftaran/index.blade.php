@extends('layouts.main')

@section('title', 'Pendaftaran')

@section('content')
    <div class="px-4 py-12">
        <h1 class="text-4xl font-extrabold text-blue-600 text-center mb-6">Pendaftaran Siswa Baru</h1>
        <p class="text-lg text-gray-600 text-center mb-8">Silakan lengkapi data diri untuk melakukan pendaftaran siswa baru di sekolah kami.</p>

        <form action="/pendaftaran-submit" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-3xl mx-auto">
            @csrf

            <!-- Grid for form fields -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Nama Siswa -->
                <div class="flex flex-col text-left">
                    <label for="nama_siswa" class="text-sm font-medium text-black">Nama Lengkap Siswa</label>
                    <input type="text" name="nama_siswa" id="nama_siswa" placeholder="Masukkan nama lengkap siswa" class="mt-1 p-2 border border-gray-300 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-300" required>
                </div>

                <!-- Nomor Telepon -->
                <div class="flex flex-col text-left">
                    <label for="no_telepon" class="text-sm font-medium text-black">Nomor Telepon</label>
                    <input type="text" name="no_telepon" id="no_telepon" placeholder="Masukkan nomor telepon siswa" class="mt-1 p-2 border border-gray-300 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-300" required>
                </div>
            </div>

            <!-- Foto Siswa -->
            <div class="flex flex-col text-left">
                <label for="foto_siswa" class="text-sm font-medium text-black">Foto Siswa</label>
                <input type="file" name="foto_siswa" id="foto_siswa" class="mt-1 p-2 border border-gray-300 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-300" accept="image/*" required>
            </div>

            <!-- Nilai Raport -->
            <div class="flex flex-col text-left">
                <label for="nilai_raport" class="text-sm font-medium text-black">Nilai Raport</label>
                <input type="file" name="nilai_raport" id="nilai_raport" class="mt-1 p-2 border border-gray-300 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-300" accept="application/pdf, image/*" required>
            </div>

            <!-- Ijazah -->
            <div class="flex flex-col text-left">
                <label for="ijazah" class="text-sm font-medium text-black">Ijazah</label>
                <input type="file" name="ijazah" id="ijazah" class="mt-1 p-2 border border-gray-300 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-300" accept="application/pdf, image/*" required>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center mt-6">
                <button type="submit" class="inline-block bg-blue-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300 hover:bg-yellow-200">
                    Daftar Sekarang
                </button>
            </div>
        </form>
    </div>
@endsection
