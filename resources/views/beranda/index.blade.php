@extends('layouts.main')

@section('title', 'Beranda')

@section('content')
    <div class="px-0 py-12">
        <!-- Welcome Section -->
        <section class="bg-gray-100 text-black shadow-xl mb-10 p-6">
            <div class="flex flex-col">

                <!-- Content Section: Text on Left and News/Pencarian on Right -->
                <div class="flex">
                <div class="w-7/10 mr-6">
                <!-- Banner Section -->
                <div>
                    <img src="{{ asset('storage/smk_icb_ct.jpeg') }}" alt="" class="w-full h-40 bg-blue-500 mb-6 flex items-center justify-center">
                </div>
                <!-- Text Section -->
                        <div class="text-left">
                            <h2 class="text-3xl font-semibold mb-4">Selamat Datang di SMK ICB Cinta Teknika</h2>
                            <p class="text-lg mb-4">SMK ICB Cinta Teknika adalah sekolah yang berfokus pada pengembangan keterampilan dan pengetahuan siswa untuk mempersiapkan mereka menghadapi tantangan dunia kerja. Kami menawarkan berbagai program pendidikan yang inovatif dan berkualitas.</p>
                            <p class="text-lg">Kami berkomitmen untuk memberikan pendidikan terbaik bagi siswa, dengan berbagai kegiatan ekstrakurikuler yang mendukung pengembangan diri dan prestasi mereka.</p>
                        </div>
                    </div>
                    <!-- Right Section: 30% of the width -->
                    <div class="w-3/10 pl-8 border-l-4 border-gray-400">
                        <!-- News Card -->
                        <div class="bg-white p-6 shadow-lg rounded-lg mb-6 hover:shadow-xl transition duration-300">
                            <h3 class="text-2xl font-semibold mb-4 text-gray-800">Berita Terbaru</h3>
                            <ul class="space-y-3 text-gray-600">
                                <li><strong>13 November 2024:</strong> Sekolah meraih juara umum lomba matematika tingkat kota.</li>
                                <li><strong>10 November 2024:</strong> Workshop pengembangan karakter untuk siswa dan guru.</li>
                            </ul>
                        </div>

                        <!-- Search Card -->
                        <div class="bg-white p-6 shadow-lg rounded-lg hover:shadow-xl transition duration-300">
                            <h3 class="text-2xl font-semibold mb-4 text-gray-800">Pencarian</h3>
                            <input type="text" class="w-full px-4 py-3 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 mb-6" placeholder="Cari berita atau artikel...">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            <!-- Section: Artikel -->
            <section id="artikel" class="bg-white text-black shadow-xl overflow-hidden">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold mb-4 hover:text-yellow-200">Artikel Terbaru</h2>
                    <p class="text-lg mb-4">Kumpulan artikel terbaru seputar pendidikan dan pengembangan diri.</p>
                    <ul class="list-disc pl-6 space-y-3">
                        <li>Pendidikan karakter dalam lingkungan sekolah</li>
                        <li>Membangun kebiasaan belajar yang efektif</li>
                    </ul>
                </div>
            </section>

            <!-- Section: Pendaftaran -->
            <section id="pendaftaran" class="bg-white text-black shadow-xl overflow-hidden transform transition hover:scale-105 duration-300">
                <div class="p-6">
                    <h2 class="text-2xl font-semibold mb-6">Pendaftaran Siswa Baru</h2>
                    <p class="text-lg mb-4">Informasi dan tata cara pendaftaran siswa baru di Sekolah Harapan Bangsa.</p>
                    <a href="/pendaftaran" class="inline-block bg-blue-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300 hover:bg-yellow-200">
                        Daftar Sekarang
                    </a>
                </div>
            </section>
        </div>
    </div>
    <div class="mt-8 flex items-start">
 
    <div class="mt-8 flex items-start space-x-6">
 
    <div class="mt-8 flex items-start">
  <!-- Bagian Kiri: Foto Kepala Sekolah -->
  <div class="w-1/3 text-center">
    <h1 class="text-3xl font-bold mb-4">KEPALA SEKOLAH</h1>
    <img src="{{ asset('storage/kepsek.jpg') }}" alt="Foto Kepala Sekolah" class="w-full h-96 object-cover rounded-lg shadow-lg">
  </div>

  <!-- Bagian Kanan: Deskripsi Kepala Sekolah -->
  <div class="w-2/3 pl-6">
    <h2 class="text-2xl font-semibold mb-2">Nama Kepala Sekolah</h2>
    <p class="text-lg mb-6">Deskripsi Kepala Sekolah yang dapat mencakup visi, misi, serta pengalaman atau latar belakang beliau di bidang pendidikan. Ini adalah tempat untuk memperkenalkan Kepala Sekolah dan nilai-nilai yang mereka bawa ke Sekolah Harapan Bangsa. Deskripsi dapat lebih panjang untuk memberikan gambaran yang jelas dan inspiratif.</p>

    <!-- Foto Tambahan di Bawah Deskripsi -->
    <div class="flex space-x-4 justify-center">
      <!-- Foto Wakasek -->
      <div class="text-center">
        <img src="{{ asset('storage/kepsek.jpg') }}" alt="Foto Wakasek" class="w-32 h-40 object-cover rounded-lg shadow-lg">
        <p class="mt-2 text-lg font-medium">Wakasek</p>
      </div>
      
      <!-- Foto Sekretaris -->
      <div class="text-center">
        <img src="{{ asset('storage/kepsek.jpg') }}" alt="Foto Sekretaris" class="w-32 h-40 object-cover rounded-lg shadow-lg">
        <p class="mt-2 text-lg font-medium">Sekretaris</p>
      </div>

      <!-- Foto Bendahara -->
      <div class="text-center">
        <img src="{{ asset('storage/kepsek.jpg') }}" alt="Foto Bendahara" class="w-32 h-40 object-cover rounded-lg shadow-lg">
        <p class="mt-2 text-lg font-medium">Bendahara</p>
      </div>
    </div>
  </div>
</div>

@endsection

