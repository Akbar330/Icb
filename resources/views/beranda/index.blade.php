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

            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const carousel = document.getElementById('carousel');
                    const slides = carousel.children;
                    const totalSlides = slides.length;
                    let currentIndex = 0;

                    function updateSlidePosition() {
                        carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
                    }


                    setInterval(() => {
                        currentIndex = (currentIndex < totalSlides - 1) ? currentIndex + 1 : 0;
                        updateSlidePosition();
                    }, 5000);
                });
            </script>

    </section>

    <!-- Welcome Section with Small Image -->
    <div class="flex items-center bg-gray-100 text-gray-800 p-6 mb-10 shadow-lg rounded-lg">
        <div class="w-3/4">
            <h2 class="text-3xl font-semibold">Selamat Datang di SMK ICB Cinta Teknika</h2>
            <!-- Garis Bawah -->
            <div class="w-1/2 h-1 bg-blue-600 mt-2 mb-4"></div>
            <p class="mt-4 text-lg">Kami adalah sekolah yang berkomitmen untuk memberikan pendidikan terbaik di bidang teknik. Di SMK ICB Cinta Teknika, siswa-siswa kami dibekali dengan pengetahuan dan keterampilan praktis yang akan mempersiapkan mereka untuk menjadi profesional di dunia industri. Bergabunglah dengan kami dan jadilah bagian dari masa depan teknologi.</p>
        </div>
        <div class="w-1/4">
            <img src="{{ asset('smk_icb_ct.jpeg') }}" alt="Gambar Sambutan" class="w-full h-32 object-cover rounded-lg shadow-md">
        </div>
    </div>

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