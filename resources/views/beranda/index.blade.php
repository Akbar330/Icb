@extends('layouts.main')

@section('title', 'Beranda')

@section('content')
<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery (opsional jika diperlukan) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<div class="px-0 py-12">
    <!-- Welcome Section -->
    <section class="bg-gray-100 text-black shadow-xl mb-10 p-6" style="min-height: 350px;">
        <div class="flex flex-col">

            <!-- Carousel Section -->
            <div class="w-full mb-6">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" style="height: 450px;">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('storage/smk_icb_ct.jpeg') }}" class="d-block w-100" style="height: 450px; object-fit: cover;" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('storage/smk_icb_ct2.jpeg') }}" class="d-block w-100" style="height: 450px; object-fit: cover;" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('storage/smk_icb_ct3.jpeg') }}" class="d-block w-100" style="height: 450px; object-fit: cover;" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <!-- Latest News Cards Section Below Carousel -->
            <div class="w-full mt-4">
                <h3 class="text-2xl font-semibold mb-4 text-gray-800">Berita Terbaru</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- News Card 1 -->
                    <div class="bg-white p-4 shadow-lg rounded-lg hover:shadow-xl transition duration-300">
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">Berita 1</h4>
                        <p class="text-gray-600 text-sm">Deskripsi singkat berita terbaru yang menarik perhatian pembaca.</p>
                    </div>
                    
                    <!-- News Card 2 -->
                    <div class="bg-white p-4 shadow-lg rounded-lg hover:shadow-xl transition duration-300">
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">Berita 2</h4>
                        <p class="text-gray-600 text-sm">Deskripsi singkat berita terbaru yang menarik perhatian pembaca.</p>
                    </div>
                    
                    <!-- News Card 3 -->
                    <div class="bg-white p-4 shadow-lg rounded-lg hover:shadow-xl transition duration-300">
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">Berita 3</h4>
                        <p class="text-gray-600 text-sm">Deskripsi singkat berita terbaru yang menarik perhatian pembaca.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            <section id="artikel" class="bg-white text-black shadow-xl overflow-hidden">
                <div class="p-6">
                    <img src="{{ ('storage/icibos.jpeg') }}" alt="">
                </div>
            </section>

            <section id="artikel" class="bg-white text-black shadow-xl overflow-hidden">
                <div class="p-6">
                    <img src="{{ ('storage/icibos.jpeg') }}" alt="">
                </div>
            </section>

            <!-- Section: Pendaftaran -->
            <section id="pendaftaran" class="bg-white text-black shadow-xl overflow-hidden transform transition hover:scale-105 duration-300">
            <div class="p-6">
                <img src="{{ ('storage/icibos.jpeg') }}" alt="" class="h-150 w-150">
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
    <img src="{{ asset('storage/pasugiyo.jpg') }}" alt="Foto Kepala Sekolah" class="w-full h-96 object-cover rounded-lg shadow-lg">
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

