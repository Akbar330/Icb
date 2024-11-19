@extends('layouts.main')

@section('title', 'Beranda')

@section('content')

<body>
    <section class="bg-gray-100 text-black shadow-xl mb-10 p-6" style="min-height: 350px;">
<!-- Carousel Section -->
<div class="relative w-full overflow-hidden" style="height: 450px;">
    <div id="carousel" class="flex transition-transform duration-700 ease-in-out" style="width: 100%; height: 450px;">
        @foreach ($carousels as $carousel)
        <div class="w-full flex-shrink-0" style="height: 450px; position: relative;">
            <!-- Gambar Carousel -->
            <img src="{{ asset('storage/' . $carousel->image_path) }}" class="w-full h-full object-cover" alt="Gambar Carousel">

            <!-- Overlay tetap di posisi kiri -->
            <div class="absolute top-0 left-0 w-[45%] h-full bg-black opacity-45" style="clip-path: polygon(0 0, 100% 0%, 100% 100%, 30% 100%); z-index: 20;"></div>
        </div>
        @endforeach
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


    <!-- Berita Section -->
    <div class="container py-4">
        <div class="row">
            <!-- Left Section: Daftar Berita (70%) -->
            <div class="col-md-8 mb-4">
                <h1 class="display-4 text-primary text-center font-bold">Berita Sekolah</h1>
                <p class="text-center text-muted mb-4">Berikut adalah berita terbaru dari sekolah.</p>

                <div class="d-flex flex-column">
                    @foreach ($berita as $item)
                    <div class="d-flex py-3 border-bottom">
                        @if ($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar Berita" class="img-fluid rounded me-3" style="width: 150px; height: 150px; object-fit: cover;">
                        @endif
                        <div>
                            <h3 class="text-primary">
                                <a href="{{ route('berita.show', $item->id) }}" class="text-decoration-none text-black">
                                    {{ $item->judul }}
                                </a>
                            </h3>
                            <p class="text-muted mb-2">{{ \Illuminate\Support\Str::limit($item->konten, 150) }}</p>
                            <small class="text-secondary">Penulis: {{ $item->penulis ?? 'Anonim' }}</small> |
                            <small class="text-secondary">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</small>
                            <br><a href="{{ route('berita.show', $item->id) }}" class="btn btn-primary mt-2">
                                Lihat Selengkapnya
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- Right Section: Kontak Sekolah (30%) -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <!-- Kontak Sekolah -->
                        <h5 class="card-title text-primary">Kontak Sekolah</h5>
                        <p class="card-text text-muted">
                            Alamat: Jalan Raya No. 123, Bandung, Jawa Barat
                        </p>
                        <p class="card-text text-muted">
                            Telepon: (022) 123-4567
                        </p>
                        <p class="card-text text-muted">
                            Email: info@sekolahku.sch.id
                        </p>
                        <p class="card-text text-muted">
                            Jam Operasional: Senin - Jumat, 08.00 - 15.00
                        </p>
                        <hr>

                        <!-- Form Pencarian Artikel -->
                        <h5 class="card-title text-primary">Cari Artikel</h5>
                        <form action="{{ route('artikel.search') }}" method="GET">
                            <div class="input-group mb-3">
                                <input type="text" name="query" class="form-control" placeholder="Cari artikel..." required>
                                <button class="btn btn-primary" type="submit">Cari</button>
                            </div>
                        </form>
                        <hr>

                        <!-- Daftar Artikel -->
                        <h5 class="card-title text-primary">Artikel Terkini</h5>
                        <ul class="list-group list-group-flush">
                            @foreach ($artikel as $artikel)
                            <li class="list-group-item">
                                <a href="{{ route('artikel.show', $artikel->id) }}" class="text-decoration-none text-black">
                                    <strong>{{ $artikel->judul }}</strong>
                                </a>
                                <p class="text-muted mb-0" style="font-size: 0.85rem;">
                                    {{ Str::limit($artikel->konten, 100) }}
                                </p>
                                <small class="text-secondary">
                                    {{ \Carbon\Carbon::parse($artikel->created_at)->format('d M Y') }}
                                </small>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bagian Galeri -->
    <div class="w-full mt-10">
        <h3 class="text-2xl font-semibold mb-4 text-gray-800">Galeri</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 mt-10">
            @foreach($gambarGaleri as $gambar)
                <section class="bg-white text-black shadow-xl overflow-hidden">
                    <div class="p-6">
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
