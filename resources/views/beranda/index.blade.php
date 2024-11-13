@extends('layouts.main')

@section('title', 'Beranda')

@section('content')
<body>
<section class="bg-gray-100 text-black shadow-xl mb-10 p-6" style="min-height: 350px;">
    <!-- Carousel Section -->
    <div class="relative w-full overflow-hidden" style="height: 450px;">
        <div id="carousel" class="flex transition-transform duration-700 ease-in-out" style="width: 300%; height: 450px;">
            <!-- Carousel Slides -->
            <div class="w-full flex-shrink-0" style="height: 450px;">
                <img src="{{ asset('storage/smk_icb_ct.jpeg') }}" class="w-full h-full object-cover" alt="Slide 1">
            </div>
            <div class="w-full flex-shrink-0" style="height: 450px;">
                <img src="{{ asset('storage/smk_icb_ct2.jpeg') }}" class="w-full h-full object-cover" alt="Slide 2">
            </div>
            <div class="w-full flex-shrink-0" style="height: 450px;">
                <img src="{{ asset('storage/smk_icb_ct3.jpeg') }}" class="w-full h-full object-cover" alt="Slide 3">
            </div>
        </div>

        <!-- Navigation Buttons -->
        <button id="prevSlide" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full hover:bg-gray-600 focus:outline-none z-10">
            &#10094;
        </button>
        <button id="nextSlide" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full hover:bg-gray-600 focus:outline-none z-10">
            &#10095;
        </button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const carousel = document.getElementById('carousel');
            const slides = carousel.children;
            const totalSlides = slides.length;
            let currentIndex = 0;

            function updateSlidePosition() {
                carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
            }

            document.getElementById('nextSlide').addEventListener('click', () => {
                currentIndex = (currentIndex < totalSlides - 1) ? currentIndex + 1 : 0;
                updateSlidePosition();
            });

            document.getElementById('prevSlide').addEventListener('click', () => {
                currentIndex = (currentIndex > 0) ? currentIndex - 1 : totalSlides - 1;
                updateSlidePosition();
            });

            setInterval(() => {
                currentIndex = (currentIndex < totalSlides - 1) ? currentIndex + 1 : 0;
                updateSlidePosition();
            }, 3000);
        });
    </script>

    <!-- Latest News Cards Section Below Carousel -->
    <div class="w-full mt-10">
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
</section>

<!-- Artikel Section -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 mt-10">
    <section id="artikel-1" class="bg-white text-black shadow-xl overflow-hidden">
        <div class="p-6">
            <img src="{{ asset('storage/icibos.jpeg') }}" alt="">
        </div>
    </section>

    <section id="artikel-2" class="bg-white text-black shadow-xl overflow-hidden">
        <div class="p-6">
            <img src="{{ asset('storage/icibos.jpeg') }}" alt="">
        </div>
    </section>

    <!-- Section: Pendaftaran -->
    <section id="pendaftaran" class="bg-white text-black shadow-xl overflow-hidden transform transition hover:scale-105 duration-300">
        <div class="p-6">
            <img src="{{ asset('storage/icibos.jpeg') }}" alt="" class="h-150 w-150">
        </div>
    </section>
</div>

<!-- Kepala Sekolah Section -->
<div class="mt-8 flex items-start space-x-6">
    <div class="w-1/3 text-center">
        <h1 class="text-3xl font-bold mb-4">KEPALA SEKOLAH</h1>
        <img src="{{ asset('storage/pasugiyo.jpg') }}" alt="Foto Kepala Sekolah" class="w-full h-96 object-cover rounded-lg shadow-lg">
    </div>

    <div class="w-2/3 pl-6">
        <h2 class="text-2xl font-semibold mb-2">Nama Kepala Sekolah</h2>
        <p class="text-lg mb-6">Deskripsi Kepala Sekolah yang dapat mencakup visi, misi, serta pengalaman atau latar belakang beliau di bidang pendidikan. Ini adalah tempat untuk memperkenalkan Kepala Sekolah dan nilai-nilai yang mereka bawa ke Sekolah Harapan Bangsa. Deskripsi dapat lebih panjang untuk memberikan gambaran yang jelas dan inspiratif.</p>

        <div class="flex space-x-4 justify-center mx-5">
            <div class="text-center">
                <img src="{{ asset('storage/kepsek.jpg') }}" alt="Foto Wakasek" class="w-32 h-40 object-cover rounded-lg shadow-lg">
                <p class="mt-2 text-lg font-medium">Wakasek</p>
            </div>
            <div class="text-center">
                <img src="{{ asset('storage/kepsek.jpg') }}" alt="Foto Sekretaris" class="w-32 h-40 object-cover rounded-lg shadow-lg">
                <p class="mt-2 text-lg font-medium">Sekretaris</p>
            </div>
            <div class="text-center">
                <img src="{{ asset('storage/kepsek.jpg') }}" alt="Foto Bendahara" class="w-32 h-40 object-cover rounded-lg shadow-lg">
                <p class="mt-2 text-lg font-medium">Bendahara</p>
            </div>
        </div>
    </div>
</div>
</body>
@endsection
