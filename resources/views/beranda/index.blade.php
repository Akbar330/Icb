@extends('layouts.main')

@section('title', 'Beranda')

@section('content')
<body>
<section class="bg-gray-100 text-black shadow-xl mb-10 p-6" style="min-height: 350px;">
    <!-- Carousel Section -->
    <div class="relative w-full overflow-hidden" style="height: 450px;">
        <div id="carousel" class="flex transition-transform duration-700 ease-in-out" style="width: 100%; height: 450px;">
            <!-- Carousel Slides -->
            <div class="w-full flex-shrink-0" style="height: 450px;">
                <img src="{{ asset('smk_icb_ct.jpeg') }}" class="w-full h-full object-cover" alt="Slide 1">
            </div>
            <div class="w-full flex-shrink-0" style="height: 450px;">
                <img src="{{ asset('smk_icb_ct2.jpeg') }}" class="w-full h-full object-cover" alt="Slide 2">
            </div>
            <div class="w-full flex-shrink-0" style="height: 450px;">
                <img src="{{ asset('smk_icb_ct3.jpeg') }}" class="w-full h-full object-cover" alt="Slide 3">
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
            }, 10000);
        });
    </script>

    <!-- Latest News Cards Section Below Carousel -->
    <div class="w-full mt-10">
    <h3 class="text-2xl font-semibold mb-4 text-gray-800">Berita Terbaru</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($berita as $item)
            <div class="bg-white p-4 shadow-lg rounded-lg hover:shadow-xl transition duration-300">
                <!-- Menampilkan Foto Berita -->
                @if ($item->gambar)
                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar Berita" class="mt-4 w-full h-48 object-cover rounded-lg">
                @endif

                <h4 class="text-lg font-semibold text-gray-800 mb-2">{{ $item->judul }}</h4>
                <p class="text-gray-600 text-sm">{{ \Illuminate\Support\Str::limit($item->konten, 100) }}</p>
                <a href="{{ route('berita.show', $item->id) }}" class="text-blue-600 mt-2 inline-block">Baca Selengkapnya</a>
            </div>
        @endforeach
    </div>
</div>


</section>

<!-- Artikel Section -->
<div class="w-full mt-10">
    <h3 class="text-2xl font-semibold mb-4 text-gray-800">Galeri</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 mt-10">
        @foreach($gambarGaleri as $gambar)
            <section class="bg-white text-black shadow-xl overflow-hidden">
                <div class="p-6">
                    <!-- Menampilkan gambar dari database -->
                    <img src="{{ asset('storage/' . $gambar->filename) }}" alt="Galeri Gambar" class="w-full h-64 object-cover rounded-lg">
                </div>
            </section>
        @endforeach
    </div>
</div>

<!-- Kepala Sekolah Section -->
<div class="mt-8 flex items-start space-x-6">
    <div class="w-1/3 text-center">
        <h1 class="text-3xl font-bold mb-4">KEPALA SEKOLAH</h1>
        <img src="{{ asset('pasugiyo.jpg') }}" alt="Foto Kepala Sekolah" class="w-full h-96 object-cover rounded-lg shadow-lg">
    </div>

    <div class="w-2/3 pl-6">
        <h2 class="text-2xl font-semibold mb-2">Nama Kepala Sekolah</h2>
        <p class="text-lg mb-6">Deskripsi Kepala Sekolah yang dapat mencakup visi, misi, serta pengalaman atau latar belakang beliau di bidang pendidikan. Ini adalah tempat untuk memperkenalkan Kepala Sekolah dan nilai-nilai yang mereka bawa ke Sekolah Harapan Bangsa. Deskripsi dapat lebih panjang untuk memberikan gambaran yang jelas dan inspiratif.</p>

        <div class="flex space-x-4 justify-center mx-5">
            <div class="text-center">
                <img src="{{ asset('kepsek.jpg') }}" alt="Foto Wakasek" class="w-32 h-40 object-cover rounded-lg shadow-lg">
                <p class="mt-2 text-lg font-medium">Wakasek</p>
            </div>
            <div class="text-center">
                <img src="{{ asset('kepsek.jpg') }}" alt="Foto Sekretaris" class="w-32 h-40 object-cover rounded-lg shadow-lg">
                <p class="mt-2 text-lg font-medium">Sekretaris</p>
            </div>
            <div class="text-center">
                <img src="{{ asset('kepsek.jpg') }}" alt="Foto Bendahara" class="w-32 h-40 object-cover rounded-lg shadow-lg">
                <p class="mt-2 text-lg font-medium">Bendahara</p>
            </div>
        </div>
    </div>
</div>

<!-- Embedded YouTube Videos Section -->
<div class="w-full mt-10">
    <h3 class="text-2xl font-semibold mb-4 text-gray-800">Activity oncam</h3>
<div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="rounded-lg overflow-hidden shadow-lg">
        <iframe width="100%" height="315" src="https://www.youtube.com/embed/l7n9k8Rzq3s?=1&mute=1" title="YouTube video" allowfullscreen></iframe>
    </div>
    <div class="rounded-lg overflow-hidden shadow-lg">
        <iframe width="100%" height="315" src="https://www.youtube.com/embed/l7n9k8Rzq3s?=1&mute=1" title="YouTube video" allowfullscreen></iframe>
    </div>
    <div class="rounded-lg overflow-hidden shadow-lg">
        <iframe width="100%" height="315" src="https://www.youtube.com/embed/l7n9k8Rzq3s?=1&mute=1" title="YouTube video" allowfullscreen></iframe>
    </div>
</div>
</body>
@endsection
