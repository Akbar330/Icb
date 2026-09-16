<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SMK ICB CT')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('icb.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Dark Mode Init Script to prevent FOUC -->
    <script>
        if (localStorage.getItem('color-theme') === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<style>
    body {
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        background-color: #F9FAFB;
        color: #333;
        scroll-behavior: smooth;
    }

    .navbar-nav .nav-item .nav-link {
        transition: color 0.3s ease-in-out, border-bottom 0.3s ease-in-out;
        position: relative;
    }
    
    .navbar-nav .nav-item .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        display: block;
        margin-top: 5px;
        right: 0;
        background: #2563EB; /* Tailwind blue-600 */
        transition: width 0.3s ease;
        -webkit-transition: width 0.3s ease;
    }

    .navbar-nav .nav-item:hover .nav-link::after {
        width: 100%;
        left: 0;
        background: #2563EB;
    }

    .navbar-nav .nav-item.active .nav-link {
        color: #2563EB !important;
        font-weight: bold;
    }
    
    .navbar-nav .nav-item.active .nav-link::after {
        width: 100%;
        left: 0;
    }

    /* Footer */
    footer {
        background-color: #1F2937; /* Tailwind gray-800 */
        color: #D1D5DB; /* Tailwind gray-300 */
    }

    footer a {
        color: #9CA3AF; /* Tailwind gray-400 */
        font-size: 0.95rem;
        transition: color 0.3s ease-in-out;
    }

    footer a:hover {
        color: #FBBF24; /* Tailwind yellow-400 */
        text-decoration: none;
    }

    /* Buttons */
    .btn {
        font-weight: 600;
        text-transform: uppercase;
        border-radius: 0.375rem; /* Tailwind rounded-md */
        transition: all 0.3s ease;
    }
    
    .btn-primary {
        background-color: #2563EB;
        border-color: #2563EB;
    }
    .btn-primary:hover {
        background-color: #1D4ED8;
        border-color: #1D4ED8;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    /* Loading Bar */
    #loading-bar {
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 4px;
        background-color: #3B82F6; /* Tailwind blue-500 */
        z-index: 9999;
        transition: width 0.4s ease;
    }

    @media (max-width: 768px) {
        .navbar-logo {
            display: none;
        }

        .right-section {
            order: 1;
        }

        .left-section {
            order: 2;
        }
    }

    /* Untuk animasi fade-out + bergerak ke kiri */
    .news-text {
        opacity: 0;
        transform: translateX(100%);
        transition: opacity 1s ease, transform 1s ease;
    }

    /* Saat berita masuk (fade-in + bergerak ke posisi semula) */
    .news-text.fade-in {
        opacity: 1;
        transform: translateX(0);
    }

    /* Saat berita keluar (fade-out + bergerak ke kiri) */
    .news-text.fade-out {
        opacity: 0;
        transform: translateX(-100%);
    }
    
    /* Global Card Hover Effect */
    .hover-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    /* Dark Mode Global Overrides */
    .dark body { background-color: #111827; color: #F3F4F6; }
    .dark .bg-white { background-color: #1F2937 !important; border-color: #374151 !important; }
    .dark .text-gray-800, .dark .text-gray-900, .dark .text-gray-700 { color: #F3F4F6 !important; }
    .dark .text-gray-600, .dark .text-gray-500 { color: #9CA3AF !important; }
    .dark .border-gray-100, .dark .border-gray-200 { border-color: #374151 !important; }
    .dark .shadow-sm, .dark .shadow-md, .dark .shadow-lg, .dark .shadow-xl, .dark .shadow-2xl { box-shadow: 0 10px 15px -3px rgba(0,0,0,0.5) !important; }
    
</style>

<body class="font-sans bg-gray-100 text-gray-800 transition-colors duration-300">
    @yield('scripts')
    <!-- Loading Bar -->
    <div id="loading-bar"></div>
    <!-- Elemen untuk menyimpan data berita -->
    <div id="berita-data" data-beritas='@json($beritas)'></div>

    <header class="bg-blue-900 py-2 shadow-lg relative" id="header">
        <div class="container mx-auto flex items-center justify-between">
            <!-- Bagian kiri: "NEWS UPDATE" -->
            <h1 class="text-xl font-bold text-white">NEWS UPDATE:</h1>

            <!-- Bagian untuk judul berita -->
            <div class="flex-grow max-w-full ml-8 text-lg text-white font-medium overflow-hidden">
                <p id="news-item" class="news-text"></p>
            </div>
        </div>
    </header>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Ambil data berita dari elemen HTML
            const beritaElement = document.getElementById('berita-data');
            const berita = JSON.parse(beritaElement.getAttribute('data-beritas')).slice(0, 3);

            // Fungsi untuk memperbarui tanggal dan waktu


            // Fungsi untuk menampilkan berita dengan animasi masuk dan keluar
            function displayNews() {
                const newsElement = document.getElementById('news-item');
                let index = 0;

                function updateNews() {
                    // Tambahkan kelas fade-out untuk animasi keluar
                    newsElement.classList.remove('fade-in');
                    newsElement.classList.add('fade-out');

                    // Tunggu sampai animasi keluar selesai sebelum mengganti berita
                    setTimeout(() => {
                        newsElement.textContent = berita[index]?.judul || "No more news!";
                        newsElement.classList.remove('fade-out'); // Hapus kelas fade-out
                        newsElement.classList.add('fade-in'); // Tambahkan kelas fade-in

                        // Pindah ke berita berikutnya, atau kembali ke awal
                        index = (index + 1) % berita.length;
                    }, 2000); // Durasi sama dengan transisi di CSS
                }

                // Tampilkan berita pertama dengan animasi masuk
                newsElement.textContent = berita[index]?.judul || "No more news!";
                newsElement.classList.add('fade-in');
                index++;

                // Ganti berita setiap 5 detik
                setInterval(updateNews, 5000);
            }

            // Jalankan fungsi saat halaman dimuat
            displayNews();
        });
    </script>


    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 shadow-sm z-50 transition-all duration-300" id="navbar">
        <div class="container">
            <div class="navbar-logo d-none d-md-block mr-3">
                <img src="{{ asset('icb.png') }}" alt="Logo SMK ICB Cinta Technika" class="h-16 w-16 object-contain">
            </div>
            <div>
                <a class="navbar-brand font-bold tracking-tight text-gray-900" style="font-size: 1.5rem;" href="/">
                    SMK ICB <span class="text-blue-600">CINTA TEKNIKA</span>
                </a>
            </div>
            <button class="navbar-toggler border-0 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto space-x-2 md:space-x-4">
                    <li class="nav-item <?php echo $_SERVER['REQUEST_URI'] == '/' ? 'active' : ''; ?>">
                        <a class="nav-link text-base font-medium text-gray-700 hover:text-blue-600" href="/">Home</a>
                    </li>
                    <li class="nav-item <?php echo $_SERVER['REQUEST_URI'] == '/informasi' ? 'active' : ''; ?>">
                        <a class="nav-link text-base font-medium text-gray-700 hover:text-blue-600" href="/informasi">Informasi</a>
                    </li>
                    <li class="nav-item <?php echo str_starts_with($_SERVER['REQUEST_URI'], '/eskul') ? 'active' : ''; ?>">
                        <a class="nav-link text-base font-medium text-gray-700 hover:text-blue-600" href="/eskul">Ekstrakurikuler</a>
                    </li>
                    <li class="nav-item <?php echo $_SERVER['REQUEST_URI'] == '/data' ? 'active' : ''; ?>">
                        <a class="nav-link text-base font-medium text-gray-700 hover:text-blue-600" href="/data">Data</a>
                    </li>
                    <li class="nav-item <?php echo $_SERVER['REQUEST_URI'] == '/biaya' ? 'active' : ''; ?>">
                        <a class="nav-link text-base font-medium text-gray-700 hover:text-blue-600" href="/biaya">Biaya Sekolah</a>
                    </li>
                    <li class="nav-item <?php echo $_SERVER['REQUEST_URI'] == '/kontak' ? 'active' : ''; ?>">
                        <a class="nav-link text-base font-medium text-gray-700 hover:text-blue-600" href="/kontak">Kontak</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-base font-medium text-gray-700 hover:text-blue-600"  href="https://spmb.smkicb-teknika.sch.id/">SPMB</a>
                    </li>
                    <li class="nav-item d-flex align-items-center ml-lg-3 mt-2 mt-lg-0">
                        <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 focus:outline-none rounded-lg text-sm p-2 transition-colors">
                            <i id="theme-toggle-dark-icon" class="hidden fas fa-moon text-lg"></i>
                            <i id="theme-toggle-light-icon" class="hidden fas fa-sun text-lg text-yellow-400"></i>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script>
        window.addEventListener('scroll', function() {
            const header = document.getElementById('header');
            const navbar = document.getElementById('navbar');
            const headerHeight = header.offsetHeight;

            if (window.scrollY > headerHeight) {
                navbar.classList.add('fixed', 'top-0', 'w-full');
            } else {
                navbar.classList.remove('fixed', 'top-0', 'w-full');
            }
        });
    </script>
    <!-- Main Content -->
    <main class="container mx-auto mt-2">
        <div class="main-content p-3 bg-white rounded shadow w-full" id="ajax-content-area">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="mt-12 py-10 shadow-inner">
        <div class="container">
            <div class="row">
                <!-- Contact Info -->
                <div class="col-md-5 text-left mb-4 mb-md-0">
                    <h4 class="text-white font-bold mb-4 flex items-center">
                        <img src="{{ asset('icb.png') }}" alt="Logo" class="h-8 w-8 mr-2 object-contain bg-white rounded-full p-1" loading="lazy">
                        SMK ICB Cinta Teknika
                    </h4>
                    <ul class="list-unstyled space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-blue-400"></i>
                            <span>Jl. Atlas Tengah No.2, Babakan Surabaya, Kec. Kiaracondong, Kota Bandung, Jawa Barat 40281</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt mr-3 text-blue-400"></i>
                            <span>(022) 7234924</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-blue-400"></i>
                            <span>icbcintateknika@gmail.com</span>
                        </li>
                    </ul>
                </div>

                <!-- Quick Links -->
                <div class="col-md-3 mb-4 mb-md-0">
                    <h5 class="text-white font-bold mb-4">Tautan Cepat</h5>
                    <ul class="list-unstyled space-y-2">
                        <li><a href="/data" class="hover:text-yellow-400 transition-colors"><i class="fas fa-chevron-right text-xs mr-2 text-blue-500"></i>Tentang Kami</a></li>
                        <li><a href="/kontak" class="hover:text-yellow-400 transition-colors"><i class="fas fa-chevron-right text-xs mr-2 text-blue-500"></i>Kontak Kami</a></li>
                        <li><a href="/berita" class="hover:text-yellow-400 transition-colors"><i class="fas fa-chevron-right text-xs mr-2 text-blue-500"></i>Berita</a></li>
                        <li><a href="/pendaftaran" class="hover:text-yellow-400 transition-colors"><i class="fas fa-chevron-right text-xs mr-2 text-blue-500"></i>Pendaftaran</a></li>
                    </ul>
                </div>

                <!-- Social Media Links -->
                <div class="col-md-4">
                    <h5 class="text-white font-bold mb-4">Ikuti Kami</h5>
                    <p class="text-sm mb-3">Tetap terhubung dengan kami melalui sosial media.</p>
                    <div class="d-flex space-x-3 mt-2">
                        <a href="#" class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-700 hover:bg-blue-600 transition-colors duration-300 text-white"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/smkicbcintateknika?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                            class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-700 hover:bg-pink-600 transition-colors duration-300 text-white"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-700 hover:bg-blue-400 transition-colors duration-300 text-white"><i class="fab fa-twitter"></i></a>
                        <a href="https://youtu.be/l7n9k8Rzq3s?si=yoHf38XKqmHwY_p6" class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-700 hover:bg-red-600 transition-colors duration-300 text-white"><i
                                class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-sm">
                <p>&copy; {{date('Y')}} <a href="https://ghdbh.smkicb-teknika.sch.id/" target="blank" class="text-blue-400 hover:text-yellow-400 transition-colors">Refactor By Indra.</a> All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @include('sweetalert::alert')
    
    <!-- Global AJAX Pagination -->
    <script>
        document.addEventListener('click', function(e) {
            const paginationLink = e.target.closest('.pagination a');
            if (paginationLink) {
                e.preventDefault();
                const url = paginationLink.href;
                
                // Cari apakah link berada di dalam container spesifik, jika tidak fallback ke ajax-content-area
                let targetContainer = paginationLink.closest('[data-ajax-container]') || document.getElementById('ajax-content-area');
                
                if(!targetContainer) return;

                const loadingBar = document.getElementById('loading-bar');
                if(loadingBar) { 
                    loadingBar.style.transition = 'width 0.4s ease, opacity 0.2s ease';
                    loadingBar.style.opacity = '1';
                    loadingBar.style.width = '40%'; 
                }

                // Efek loading pada container
                const originalOpacity = targetContainer.style.opacity;
                targetContainer.style.opacity = '0.5';
                targetContainer.style.pointerEvents = 'none';

                fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(response => response.text())
                .then(html => {
                    if(loadingBar) loadingBar.style.width = '80%';
                    
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    
                    let newContainer;
                    if(targetContainer.id) {
                        newContainer = doc.getElementById(targetContainer.id);
                    }
                    
                    if (newContainer) {
                        targetContainer.innerHTML = newContainer.innerHTML;
                        window.history.pushState({}, '', url);
                        
                        // Scroll ke atas container jika di luar viewport
                        const rect = targetContainer.getBoundingClientRect();
                        if(rect.top < 0) {
                            window.scrollTo({ top: targetContainer.offsetTop - 100, behavior: 'smooth' });
                        }
                        
                        // Re-initialize AOS if available so new elements don't stay invisible
                        if (typeof AOS !== 'undefined') {
                            setTimeout(() => { AOS.init(); }, 100);
                        }
                    }
                })
                .catch(err => console.error(err))
                .finally(() => {
                    targetContainer.style.opacity = originalOpacity || '1';
                    targetContainer.style.pointerEvents = 'auto';
                    
                    if(loadingBar) {
                        loadingBar.style.width = '100%';
                        setTimeout(() => { 
                            loadingBar.style.opacity = '0'; 
                            setTimeout(() => { loadingBar.style.width = '0%'; }, 200);
                        }, 300);
                    }
                });
            }
        });
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Init AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 50
        });

        // Theme Toggle Script
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        if (localStorage.getItem('color-theme') === 'dark') {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');
        themeToggleBtn.addEventListener('click', function() {
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }
        });
    </script>
</body>

</html>
