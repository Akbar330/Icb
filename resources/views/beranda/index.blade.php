@extends('layouts.main')

@section('title', 'Beranda')

@section('content')

    <body>
        <section class="mb-12 shadow-2xl rounded-b-xl overflow-hidden relative" style="min-height: 450px;">
            <!-- Carousel Section -->
            <div class="relative w-full overflow-hidden" style="height: 450px;">
                <div id="carousel" class="flex transition-transform duration-700 ease-in-out"
                    style="width: 100%; height: 450px;">
                    @foreach ($carousels as $index => $carousel)
                        <div class="w-full flex-shrink-0" style="height: 450px; position: relative;">
                            <!-- Gambar Carousel -->
                            <img src="{{ asset('storage/' . $carousel->image_path) }}" class="w-full h-full object-cover"
                                alt="Gambar Carousel" {{ $index > 0 ? 'loading="lazy"' : '' }}>

                            <!-- Overlay tetap di posisi kiri -->
                            <div class="absolute top-0 left-0 w-full md:w-[50%] h-full bg-gradient-to-r from-black/80 to-transparent z-20"></div>

                            <!-- Overlay Teks -->
                            <div class="absolute top-1/2 left-6 md:left-12 transform -translate-y-1/2 text-white z-30">
                                @if ($index == 0)
                                    <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight drop-shadow-lg">SELAMAT DATANG DI SMK ICB</h1>
                                    <p class="text-lg md:text-xl mt-3 font-light text-gray-200">Pusat pendidikan kejuruan yang unggul.</p>
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
        <div class="container mb-12">
            <div class="flex flex-col md:flex-row items-center bg-white p-8 md:p-12 shadow-xl hover-card rounded-2xl border border-gray-100" data-aos="fade-up">
                <div class="md:w-5/12 w-full mb-6 md:mb-0 md:pr-8">
                    <div class="overflow-hidden rounded-xl shadow-lg">
                        <img src="{{ asset('bghome.png') }}" alt="Gambar Sambutan"
                            class="w-full h-auto object-cover transform hover:scale-105 transition duration-500" loading="lazy">
                    </div>
                </div>
                <div class="md:w-7/12 w-full">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 text-center md:text-left tracking-tight">Selamat Datang di SMK ICB Cinta Teknika</h2>
                    <!-- Garis Bawah -->
                    <div class="w-20 h-1.5 bg-blue-600 mt-4 mb-6 mx-auto md:mx-0 rounded-full"></div>
                    <p class="text-gray-600 text-lg leading-relaxed text-center md:text-left">
                        Kami adalah sekolah yang berkomitmen untuk memberikan pendidikan terbaik di bidang teknik. Di SMK ICB
                        Cinta Teknika, siswa-siswa kami dibekali dengan pengetahuan dan keterampilan praktis yang akan
                        mempersiapkan mereka untuk menjadi profesional di dunia industri. Bergabunglah dengan kami dan jadilah
                        bagian dari masa depan teknologi.
                    </p>
                </div>
            </div>
        </div>

        <!-- Container untuk Artikel dan Kontak Sekolah -->
        <div class="container py-8">
            <div class="row">

                <!-- Left Section: Daftar Artikel (70%) -->
                <div class="col-lg-8 order-2 order-lg-1 mb-5 left-section" id="artikel-container" data-ajax-container>
                    <div class="mb-5" data-aos="fade-right">
                        <h2 class="text-3xl font-bold text-gray-800 border-l-4 border-blue-600 pl-3">Artikel Terbaru</h2>
                        <p class="text-gray-500 mt-2">Berikut adalah beberapa artikel terbaru untuk Anda.</p>
                    </div>
                    
                    <div class="space-y-6">
                        @if ($artikel->isEmpty())
                            <p class="text-gray-500 italic">Tidak ada artikel tersedia.</p>
                        @else
                            @foreach ($artikel as $item)
                                <div class="bg-white rounded-xl shadow-md hover-card overflow-hidden border border-gray-100 flex flex-col sm:flex-row" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                    <!-- Gambar Artikel -->
                                    <div class="sm:w-1/3 h-48 sm:h-auto overflow-hidden relative">
                                        <img src="{{ $item->gambar !== null ? asset('storage/' . $item->gambar) : asset('foto_artikel.jpg') }}"
                                            alt="{{ $item->judul }}" class="w-full h-full object-cover transition duration-500 hover:scale-110" loading="lazy">
                                    </div>
                                    <!-- Judul dan Deskripsi Artikel -->
                                    <div class="p-5 sm:w-2/3 flex flex-col justify-between">
                                        <div>
                                            <h3 class="text-xl font-bold text-gray-800 hover:text-blue-600 transition-colors mb-2">
                                                <a href="{{ route('artikel.show', $item->id) }}" class="text-decoration-none text-inherit">
                                                    {{ $item->judul }}
                                                </a>
                                            </h3>
                                            <p class="text-gray-600 text-sm leading-relaxed mb-4">
                                                {{ \Illuminate\Support\Str::limit($item->deskripsi, 120) }}
                                            </p>
                                        </div>
                                        <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                                            <div class="text-xs text-gray-500 flex flex-col">
                                                <span><i class="fas fa-user-edit mr-1"></i> {{ $item->penulis }}</span>
                                                <span class="mt-1"><i class="far fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }} &bull; <i class="fas fa-eye ml-1 mr-1"></i> {{ $item->views }}</span>
                                            </div>
                                            <a href="{{ route('artikel.show', $item->id) }}" class="btn btn-sm btn-outline-primary rounded-full px-4 font-semibold hover:bg-blue-600 hover:text-white transition-colors">
                                                Baca
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-8">
                        {{ $artikel->appends(['artikel_page' => request('artikel_page')])->links('pagination::bootstrap-4') }}
                    </div>
                </div>

                <!-- Right Section: Sapaan Sekolah (30%) di atas artikel untuk perangkat kecil -->
                <div class="col-lg-4 order-1 order-lg-2 mb-5 right-section" data-aos="fade-left">
                    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden sticky-top" style="top: 100px; z-index: 10;">
                        <!-- Bagian Header Biru -->
                        <div class="bg-blue-600 text-white text-center py-4">
                            <h3 class="font-bold text-lg m-0 tracking-wide">SAPAAN KEPALA SEKOLAH</h3>
                        </div>
                        <div class="p-5">
                            <div class="w-32 h-32 mx-auto mb-4 overflow-hidden rounded-full border-4 border-white shadow-md">
                                <img id="sapaan-img" src="{{ asset('kepsex.jpg') }}" alt="Foto Kepala Sekolah"
                                    class="w-full h-full object-cover" loading="lazy">
                            </div>
                            <p id="sapaan_text" class="text-center text-gray-600 italic text-sm leading-relaxed mb-6">
                            </p>

                            <hr class="border-gray-200 mb-6">

                            <!-- Polling -->
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                                <h5 class="text-blue-600 font-bold mb-3 flex items-center"><i class="fas fa-poll mr-2"></i> POLLING SEKOLAH</h5>
                                <h6 id="fallbackPolling" class="text-sm text-gray-500 italic">Polling Tidak Tersedia</h6>
                                @if ($masterPolling !== null)
                                    <div id="pollingSection">
                                        <p class="font-semibold text-gray-800 text-sm mb-3">{{ $masterPolling->nama_polling }}</p>
                                        <div id="hasilVote" style="display: none;" class="space-y-3">
                                            <div>
                                                <div class="flex justify-between text-xs mb-1">
                                                    <span class="font-medium text-gray-700">{{ $listPilihan[0]->option }}</span>
                                                    <span id="bagusPercentage" class="font-bold text-green-600">0%</span>
                                                </div>
                                                <div class="progress" style="height: 8px;">
                                                    <div class="progress-bar bg-success rounded-full" role="progressbar" id="bagusProgress"
                                                        style="width: 0%"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="flex justify-between text-xs mb-1">
                                                    <span class="font-medium text-gray-700">{{ $listPilihan[1]->option }}</span>
                                                    <span id="kurangBagusPercentage" class="font-bold text-yellow-500">0%</span>
                                                </div>
                                                <div class="progress" style="height: 8px;">
                                                    <div class="progress-bar bg-warning rounded-full" role="progressbar" id="kurangBagusProgress"
                                                        style="width: 0%"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="flex justify-between text-xs mb-1">
                                                    <span class="font-medium text-gray-700">{{ $listPilihan[2]->option }}</span>
                                                    <span id="burukPercentage" class="font-bold text-red-500">0%</span>
                                                </div>
                                                <div class="progress" style="height: 8px;">
                                                    <div class="progress-bar bg-danger rounded-full" role="progressbar" id="burukProgress"
                                                        style="width: 0%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <form action="{{ route('vote.store') }}" method="post" class="mt-3" id="formPoll">
                                            @csrf
                                            <input type="hidden" name="id_polling" value="{{ $masterPolling->id }}">
                                            <div class="space-y-2 mb-3">
                                                @foreach ($listPilihan as $pilihanVote)
                                                    <label class="flex items-center space-x-3 cursor-pointer p-2 rounded hover:bg-gray-100 transition-colors">
                                                        <input type="radio" name="pilihan" class="form-radio text-blue-600 h-4 w-4" value="{{ $pilihanVote->id }}">
                                                        <span class="text-sm text-gray-700">{{ $pilihanVote->option }}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                            <button type="submit" class="w-full btn btn-primary py-2 text-sm font-bold tracking-wide rounded-md">Kirim Suara</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Berita Section -->
        <div class="bg-white py-12 shadow-sm border-t border-b border-gray-100">
            <div class="container">
                <div class="row justify-content-center">
                    <!-- Left Section: Daftar Berita (80%) -->
                    <div class="col-lg-10 mb-4" id="berita-container" data-ajax-container>
                        <div class="text-center mb-10" data-aos="fade-up">
                            <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Berita Sekolah</h2>
                            <div class="w-16 h-1 bg-blue-600 mx-auto mt-3 rounded-full"></div>
                            <p class="text-gray-500 mt-3">Informasi dan berita terbaru seputar kegiatan di lingkungan sekolah.</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach ($berita as $item)
                                <div class="bg-white rounded-xl shadow-md hover-card overflow-hidden border border-gray-100 flex flex-col h-full" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                    <div class="h-48 overflow-hidden relative bg-gray-50 flex items-center justify-center border-b border-gray-100">
                                        <img src="{{ $item->gambar !== null ? asset('storage/' . $item->gambar) : asset('foto_berita.jpg') }}"
                                            alt="{{ $item->judul }}" class="w-full h-full object-contain p-2 transition duration-500 hover:scale-105" loading="lazy">
                                    </div>
                                    <div class="p-5 flex-grow flex flex-col">
                                        <h3 class="text-xl font-bold text-gray-800 hover:text-blue-600 transition-colors mb-2">
                                            <a href="{{ route('berita.show', $item->id) }}" class="text-decoration-none text-inherit">
                                                {{ $item->judul }}
                                            </a>
                                        </h3>
                                        <div class="text-xs text-blue-600 font-semibold mb-3">
                                            <i class="far fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                                        </div>
                                        <p class="text-gray-600 text-sm leading-relaxed mb-4 flex-grow">
                                            {{ \Illuminate\Support\Str::limit($item->deskripsi, 120) }}
                                        </p>
                                        <div class="mt-auto border-t border-gray-100 pt-3 flex justify-between items-center">
                                            <span class="text-xs text-gray-500"><i class="fas fa-eye mr-1"></i> {{ $item->views }} views</span>
                                            <a href="{{ route('berita.show', $item->id) }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800">Baca <i class="fas fa-arrow-right ml-1"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-10">
                            {{ $berita->appends(['berita_page' => request('berita_page')])->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian Ekstrakurikuler & Kegiatan Siswa -->
        <div class="container mt-16 mb-12">
            <div class="text-center mb-10" data-aos="zoom-in">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 uppercase tracking-wider mb-2">Bakat & Minat</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-800 tracking-tight">Ekstrakurikuler & Kegiatan</h2>
                <div class="w-20 h-1.5 bg-blue-600 mx-auto mt-3 rounded-full"></div>
                <p class="text-gray-500 mt-3 text-sm sm:text-base max-w-2xl mx-auto">Wadah pengembangan kreativitas, kepemimpinan, dan prestasi siswa di lingkungan SMK ICB Cinta Teknika.</p>
            </div>
            
            @if(isset($eskuls) && $eskuls->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    @foreach ($eskuls as $eskul)
                        <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 overflow-hidden border border-gray-100 flex flex-col group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="relative h-48 bg-gradient-to-br from-blue-600 to-indigo-700 overflow-hidden flex items-center justify-center">
                                @if($eskul->foto)
                                    <img src="{{ asset('storage/' . $eskul->foto) }}" alt="{{ $eskul->nama_eskul }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500" loading="lazy">
                                @else
                                    <div class="w-16 h-16 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center text-white text-3xl">
                                        <i class="fas fa-users"></i>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                <span class="absolute top-3 right-3 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-white/90 text-blue-700 shadow-sm">
                                    {{ $eskul->kategori }}
                                </span>
                            </div>
                            <div class="p-5 flex-1 flex flex-col justify-between">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition mb-1">
                                        {{ $eskul->nama_eskul }}
                                    </h3>
                                    <p class="text-gray-500 text-xs line-clamp-2 mb-3">
                                        {{ $eskul->deskripsi ?: 'Kembangkan minat dan keahlianmu bersama ekstrakurikuler ' . $eskul->nama_eskul . '.' }}
                                    </p>
                                    @if($eskul->jadwal)
                                        <div class="flex items-center gap-1.5 text-xs text-gray-500 mb-2">
                                            <i class="far fa-clock text-blue-500"></i>
                                            <span>{{ $eskul->jadwal }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="pt-3 border-t border-gray-100 flex items-center justify-between">
                                    <span class="text-xs text-gray-400"><i class="far fa-images mr-1"></i> {{ $eskul->kegiatans_count }} Kegiatan</span>
                                    <a href="{{ route('eskul.show', $eskul->slug) }}" class="text-xs font-semibold text-blue-600 hover:text-blue-800 inline-flex items-center gap-1">
                                        Detail <i class="fas fa-chevron-right text-[10px]"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Fallback galeri jika eskul belum ada data -->
                <div id="galeri-container" data-ajax-container>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6 relative">
                        @foreach ($gambarGaleri as $gambar)
                            <div class="bg-white rounded-xl shadow-sm hover-card overflow-hidden group border border-gray-100" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 50 }}">
                                <div class="relative h-48 md:h-56 bg-gray-100 flex items-center justify-center">
                                    <img src="{{ asset('storage/' . $gambar->filename) }}" alt="Galeri Gambar"
                                        class="w-full h-full object-contain p-2 transition duration-500 group-hover:scale-110" loading="lazy">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="text-center mt-8">
                <a href="{{ route('eskul.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm shadow-md shadow-blue-500/20 transition-all transform hover:-translate-y-0.5">
                    <span>Jelajahi Seluruh Ekstrakurikuler</span>
                    <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>

        <!-- Embedded YouTube Videos Section -->
        <div class="container mt-12 mb-16">
            <div class="text-center mb-8" data-aos="fade-up">
                <h2 class="text-3xl font-bold text-gray-800">Activity Oncam</h2>
                <div class="w-16 h-1 bg-red-600 mx-auto mt-3 rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="oncam-container" data-ajax-container>
                @foreach ($oncams as $oncam)
                    <div class="rounded-xl overflow-hidden shadow-lg hover-card bg-black" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <iframe width="100%" height="250" src="{{ $oncam->embed_link }}" title="Oncam Video"
                            class="w-full" allowfullscreen loading="lazy">
                        </iframe>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-8">
                {{ $oncams->appends(['oncam_page' => request('oncam_page')])->links('pagination::bootstrap-4') }}
            </div>
        </div>
        <script>
            // Data hasil polling (ini bisa diambil dari API atau backend)
            const totalVotes = {{ $totalVotes }};
            const pilihan = @json($pilihan);
            const isVoting = @json($isVoting);
            const pollingAya = @json($pollingAya);
            const resultPoll = document.getElementById('hasilVote');
            const formPoll = document.getElementById('formPoll');
            const pollingSec = document.getElementById('pollingSection');
            const fallbackPol = document.getElementById('fallbackPolling');
            const sapaanTextElement = document.getElementById('sapaan_text');
            const imgElement = document.getElementById('sapaan-img');

            const sapaanRAW = @json($sapaan);
            const sapaan = JSON.parse(sapaanRAW);
            if (resultPoll && formPoll) {
                if (isVoting) {
                    resultPoll.style.display = 'block';
                    formPoll.style.display = 'none';
                } else {
                    resultPoll.style.display = 'none';
                    formPoll.style.display = 'block';
                }
            }

            if (pollingSec && fallbackPol) {
                if (pollingAya) {
                    pollingSec.style.display = 'block';
                    fallbackPol.style.display = 'none';
                } else {
                    pollingSec.style.display = 'none';
                    fallbackPol.style.display = 'block';
                }
            }

            // Fungsi untuk menghitung persentase
            function calculatePercentage(count, total) {
                return total > 0 ? (count / total) * 100 : 0;
            }
            // Set the random sapaan text to the <p> element

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
                const bagusPercent = calculatePercentage(pilihan[0]?.count || 0, totalVotes);
                const kurangBagusPercent = calculatePercentage(pilihan[1]?.count || 0, totalVotes);
                const burukPercent = calculatePercentage(pilihan[2]?.count || 0, totalVotes);

                // Update progress bar
                if (bagusProgress && bagusPercentage) {
                    bagusProgress.style.width = `${bagusPercent}%`;
                    bagusProgress.setAttribute("aria-valuenow", bagusPercent);
                    bagusPercentage.textContent = `${Math.round(bagusPercent)}%`;
                }

                if (kurangBagusProgress && kurangBagusPercentage) {
                    kurangBagusProgress.style.width = `${kurangBagusPercent}%`;
                    kurangBagusProgress.setAttribute("aria-valuenow", kurangBagusPercent);
                    kurangBagusPercentage.textContent = `${Math.round(kurangBagusPercent)}%`;
                }

                if (burukProgress && burukPercentage) {
                    burukProgress.style.width = `${burukPercent}%`;
                    burukProgress.setAttribute("aria-valuenow", burukPercent);
                    burukPercentage.textContent = `${Math.round(burukPercent)}%`;
                }
            }

            document.addEventListener('DOMContentLoaded', () => {
                updateProgressBar();
                const randomSapaan = getRandomSapaan();
                if (sapaanTextElement) {
                    sapaanTextElement.textContent = randomSapaan.sapaan || "Selamat Pagi!";
                }
                if (imgElement) {
                    imgElement.src = randomSapaan.gambar ?
                        `/storage/${randomSapaan.gambar}` :
                        'kepsex.jpg';
                }
            });
        </script>
    </body>
@endsection
