@extends('layouts.main')

@section('title', 'Beranda')

@section('content')

    <body>
        <section class="bg-gray-100 text-black shadow-xl mb-10 p-2" style="min-height: 350px;">
            <!-- Carousel Section -->
            <div class="relative w-full overflow-hidden" style="height: 450px;">
                <div id="carousel" class="flex transition-transform duration-700 ease-in-out"
                    style="width: 100%; height: 450px;">
                    @foreach ($carousels as $index => $carousel)
                        <div class="w-full flex-shrink-0" style="height: 450px; position: relative;">
                            <!-- Gambar Carousel -->
                            <img src="{{ asset('storage/' . $carousel->image_path) }}" class="w-full h-full object-cover"
                                alt="Gambar Carousel">

                            <!-- Overlay tetap di posisi kiri -->
                            <div class="absolute top-0 left-0 w-[45%] h-full bg-black opacity-45"
                                style="clip-path: polygon(0 0, 100% 0%, 100% 100%, 30% 100%); z-index: 20;"></div>

                            <!-- Overlay Teks -->
                            <div class="absolute top-1/2 left-10 transform -translate-y-1/2 text-white z-30">
                                @if ($index == 0)
                                    <h1 class="text-4xl font-bold">SELAMAT DATANG DI SMK ICB</h1>
                                    <p class="text-lg mt-2">Pusat pendidikan kejuruan yang unggul.</p>
                                @endif
                                <!-- Anda dapat menambahkan teks berbeda untuk slide lain di sini -->
                            </div>
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
        <div class="flex flex-col md:flex-row items-center bg-gray-100 text-gray-800 p-6 mb-10 shadow-lg rounded-lg">
            <div class="md:w-1/3 w-full mb-4 md:mb-0">
                <img src="{{ asset('smk_icb_ct.jpeg') }}" alt="Gambar Sambutan"
                    class="w-full h-auto object-cover rounded-lg shadow-md">
            </div>
            <div class="md:w-2/3 w-full md:pl-6">
                <h2 class="text-2xl md:text-3xl font-semibold mt-3 text-center md:text-left">Selamat Datang di SMK ICB Cinta
                    Teknika</h2>
                <!-- Garis Bawah -->
                <div class="w-1/2 h-1 bg-blue-600 mt-2 mb-4 mx-auto md:mx-0"></div>
                <p class="mt-4 text-base md:text-lg text-center md:text-left">
                    Kami adalah sekolah yang berkomitmen untuk memberikan pendidikan terbaik di bidang teknik. Di SMK ICB
                    Cinta Teknika, siswa-siswa kami dibekali dengan pengetahuan dan keterampilan praktis yang akan
                    mempersiapkan mereka untuk menjadi profesional di dunia industri. Bergabunglah dengan kami dan jadilah
                    bagian dari masa depan teknologi.
                </p>
            </div>
        </div>

        <!-- Container untuk Artikel dan Kontak Sekolah -->
        <div class="container py-4">
            <div class="row">

                <!-- Left Section: Daftar Artikel (70%) -->
                <div class="col-md-8 order-1 order-md-1 mb-4 left-section">
                    <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold">Artikel Terbaru</h1>
                    <p class="text-left text-muted mb-4">Berikut adalah beberapa artikel terbaru untuk Anda.</p>
                    <ul class="list-group list-group-flush">
                        @if ($artikel->isEmpty())
                            <p>Tidak ada artikel tersedia.</p>
                        @else
                            @foreach ($artikel as $item)
                                <li class="list-group-item">
                                    <div class="d-flex flex-column flex-md-row align-items-start">
                                        <!-- Gambar Artikel -->
                                        <div class="flex-shrink-0 mb-3 mb-md-0 me-md-3 text-center">
                                            <img src="{{ $item->gambar !== null ? asset('storage/' . $item->gambar) : asset('foto_artikel.jpg') }}"
                                                alt="Gambar Artikel" class="img-thumbnail" style="width:250px;">
                                        </div>
                                        <!-- Judul dan Deskripsi Artikel -->
                                        <div class="ml-2">
                                            <div class="flex-grow-1">
                                                <h3 class="text-primary mb-1 text-left text-md-start">
                                                    <a href="{{ route('artikel.show', $item->id) }}"
                                                        class="text-decoration-none text-black">
                                                        {{ $item->judul }}
                                                    </a>
                                                </h3>
                                                <p class="text-muted mb-2 text-left text-md-start">
                                                    {{ \Illuminate\Support\Str::limit($item->deskripsi, 150) }}
                                                </p>
                                                <div class="text-left text-md-start">
                                                    <a href="{{ route('artikel.show', $item->id) }}"
                                                        class="btn btn-primary btn-sm">
                                                        Baca Selengkapnya
                                                    </a>
                                                </div>
                                                <div class="text-secondary text-left text-md-start mt-2">
                                                    <small>Penulis: {{ $item->penulis }}</small><br>
                                                    <small>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</small>
                                                    <small class="text-secondary"> Dilihat: {{ $item->views }} kali</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                    <!-- Pagination -->
                    <div class="d-flex justify-content mt-4">
                        {{ $artikel->appends(['artikel_page' => request('artikel_page')])->links('pagination::bootstrap-4') }}
                    </div>
                </div>

                <!-- Right Section: Sapaan Sekolah (30%) di atas artikel untuk perangkat kecil -->
                <div class="col-md-4 order-2 order-md-2 right-section">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-primary font-weight-bold text-center">
                                SAPAAN KEPALA SEKOLAH
                            </h3>
                            <div class="card mx-auto mt-3 mb-3" style="width: 200px; height: 200px;">
                                <img id="sapaan-img" src="{{ asset('kepsex.jpg') }}" alt="Foto Kepala Sekolah"
                                    class="card-img-top" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <p id="sapaan_text" class="text-center">
                            </p>

                            <!-- Polling -->
                            <h5 class="text-blue font-bold mt-10"> POLLING SEKOLAH </h5>
                            <div class="container mt-3" id="hasilVote" style="display: none;">
                                <p><strong>Bagus</strong>: <span id="bagusPercentage">0%</span></p>
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-success" role="progressbar" id="bagusProgress"
                                        style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p><strong>Kurang Bagus</strong>: <span id="kurangBagusPercentage">0%</span></p>
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-warning" role="progressbar" id="kurangBagusProgress"
                                        style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p><strong>Buruk</strong>: <span id="burukPercentage">0%</span></p>
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-danger" role="progressbar" id="burukProgress"
                                        style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <form action="{{ route('vote.store') }}" method="post" class="mt-2" id="formPoll">
                                @csrf
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pilihan" id="flexRadioDefault1"
                                        value="1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Baik
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pilihan" id="flexRadioDefault2"
                                        value="2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Kurang Baik
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="pilihan" id="flexRadioDefault2"
                                        value="3">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Buruk
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary mt-2">Kirim</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Berita Section -->
        <div class="container py-4">
            <div class="row">
                <!-- Left Section: Daftar Berita (70%) -->
                <div class="col-md-8 mb-4">
                    <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold">Berita Sekolah</h1>
                    <p class="text-left text-muted mb-4">Berikut adalah berita terbaru dari sekolah.</p>
                    <div class="d-flex flex-column">
                        @foreach ($berita as $item)
                            <div class="d-flex flex-column flex-md-row py-3 border-bottom">
                                <!-- Card untuk gambar -->
                                <div class="flex-shrink-0 mb-3 mb-md-0 me-md-3 text-center">
                                    <img src="{{ $item->gambar !== null ? asset('storage/' . $item->gambar) : asset('foto_artikel.jpg') }}"
                                        alt="Gambar Berita" class="img-thumbnail" style="object-fit:scale-down;">
                                </div>

                                <!-- Konten Berita -->
                                <div class="ml-2">
                                    <div class="flex-grow-1">
                                        <h3 class="text-primary mb-2 text-left text-md-start">
                                            <a href="{{ route('berita.show', $item->id) }}"
                                                class="text-decoration-none text-black">
                                                {{ $item->judul }}
                                            </a>
                                        </h3>
                                        <p class="text-muted mb-2 text-left text-md-start">
                                            {{ \Illuminate\Support\Str::limit($item->deskripsi, 150) }}
                                        </p>
                                        <div class="text-secondary text-left text-md-start">
                                            <small>Penulis: {{ $item->penulis ?? 'Anonim' }}</small> |
                                            <small>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</small>
                                        </div>
                                        <div class="text-left text-md-start mt-3">
                                            <a href="{{ route('berita.show', $item->id) }}" class="btn btn-primary">
                                                Lihat Selengkapnya
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content mt-4">
                        {{ $berita->appends(['artikel_page' => request('artikel_page')])->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian Galeri -->
        <div class="w-full mt-10">
            <h3 class="text-2xl font-semibold mb-4 text-gray-800">Galeri</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 mt-10">
                @foreach ($gambarGaleri as $gambar)
                    <section class="bg-white text-black shadow-xl overflow-hidden">
                        <div class="p-2">
                            <img src="{{ asset('storage/' . $gambar->filename) }}" alt="Galeri Gambar"
                                class="w-full h-64 object-contain rounded-lg">
                        </div>
                    </section>
                @endforeach
                <div class="d-flex justify-content mt-4">
                    {{ $gambarGaleri->appends(['galeri_page' => request('galeri_page')])->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>

        <!-- Embedded YouTube Videos Section -->
        <div class="w-full mt-10">
            <h3 class="text-2xl font-semibold mb-4 text-gray-800">Activity Oncam</h3>
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach ($oncams as $oncam)
                    <div class="rounded-lg overflow-hidden shadow-lg">
                        <iframe width="100%" height="315" src="{{ $oncam->embed_link }}" title="Oncam Video"
                            allowfullscreen>
                        </iframe>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $oncams->appends([
                        'berita_page' => request('berita_page'),
                        'artikel_page' => request('artikel_page'),
                        'galeri_page' => request('galeri_page'),
                    ])->links('pagination::bootstrap-4') }}
            </div>
        </div>
        <script>
            // Data hasil polling (ini bisa diambil dari API atau backend)
            const totalVotes = {{ $totalVotes }};
            const pilihan = @json($pilihan);
            const isVoting = @json($isVoting);
            const resultPoll = document.getElementById('hasilVote');
            const formPoll = document.getElementById('formPoll');
            const sapaanTextElement = document.getElementById('sapaan_text');
            const imgElement = document.getElementById('sapaan-img');

            const sapaanRAW = @json($sapaan);
            const sapaan = JSON.parse(sapaanRAW);
            if (isVoting) {
                resultPoll.style.display = 'block'
                formPoll.style.display = 'none'
            } else {
                resultPoll.style.display = 'none'
                formPoll.style.display = 'block'
            }
            // Fungsi untuk menghitung persentase
            function calculatePercentage(count, total) {
                return total > 0 ? (count / total) * 100 : 0;
            }
            const getRandomSapaan = () => {
                if (sapaan.length > 0) {
                    const randomIndex = Math.floor(Math.random() * sapaan.length);
                    return sapaan[randomIndex];
                } else {
                    return {
                        sapaan: "Selamat Pagi!",
                        gambar: null
                    };
                }
            };

            // Set the random sapaan text to the <p> element


            // Update progress bar secara dinamis
            function updateProgressBar() {
                // Ambil elemen progress bar
                const bagusProgress = document.getElementById("bagusProgress");
                const kurangBagusProgress = document.getElementById("kurangBagusProgress");
                const burukProgress = document.getElementById("burukProgress");

                // Ambil elemen untuk persentase
                const bagusPercentage = document.getElementById("bagusPercentage");
                const kurangBagusPercentage = document.getElementById("kurangBagusPercentage");
                const burukPercentage = document.getElementById("burukPercentage");

                // Hitung persentase
                const bagusPercent = calculatePercentage(pilihan["1"] || 0, totalVotes);
                const kurangBagusPercent = calculatePercentage(pilihan['2'] || 0, totalVotes);
                const burukPercent = calculatePercentage(pilihan['3'] || 0, totalVotes);

                // Update progress bar
                bagusProgress.style.width = `${bagusPercent}%`;
                bagusProgress.setAttribute("aria-valuenow", bagusPercent);
                bagusPercentage.textContent = `${Math.round(bagusPercent)}%`;

                kurangBagusProgress.style.width = `${kurangBagusPercent}%`;
                kurangBagusProgress.setAttribute("aria-valuenow", kurangBagusPercent);
                kurangBagusPercentage.textContent = `${Math.round(kurangBagusPercent)}%`;

                burukProgress.style.width = `${burukPercent}%`;
                burukProgress.setAttribute("aria-valuenow", burukPercent);
                burukPercentage.textContent = `${Math.round(burukPercent)}%`;
            }

            document.addEventListener('DOMContentLoaded', () => {
                updateProgressBar();
                const randomSapaan = getRandomSapaan();
                sapaanTextElement.textContent = randomSapaan.sapaan;
                // Perbarui src gambar di halaman
                imgElement.src = randomSapaan.gambar ?
                    `/storage/${randomSapaan.gambar}` :
                    'kepsex.jpg'; // Gambar default jika gambar null

            });
        </script>
    </body>
@endsection
