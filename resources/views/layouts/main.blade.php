<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SMK ICB CT')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" href="{{asset('icb.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F9FAFB;
            color: #333;
        }

        .navbar-nav .nav-item.active .nav-link {
            color: black;
            font-weight: bold;
            border-bottom: 3px solid black;
            padding-bottom: 1px;
        }

        /* Footer */
        footer {
            background-color: #2D3748;
            padding: 15px 0;
            color: #CBD5E0;
        }

        footer a {
            color: #CBD5E0;
            font-size: 0.875rem;
            transition: color 0.3s;
        }

        footer a:hover {
            color: #F1C40F;
        }

        /* Buttons */
        .btn {
            font-weight: 600;
            text-transform: uppercase;
        }

        /* Loading Bar */
        #loading-bar {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 5px;
            background-color: #4CAF50;
            z-index: 9999;
            transition: width 0.5s ease-in-out;
        }

        @media (max-width: 768px) {
        .navbar-logo {
            display: none;
        }
    }
    </style>
</head>

<body class="font-sans bg-gray-100 text-gray-800">

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

<style>
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

</style>


<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white py-1 shadow-md z-10" id="navbar">
    <div class="container">
        <div class="navbar-logo d-none d-md-block">
            <img src="{{ asset('icb.png') }}" alt="Logo SMK ICB Cinta Technika" class="h-20 w-20">
        </div>        
        <div class="ml-4">
            <a class="navbar-brand d-block text-right" style="font-size: 1.5rem; color: black;">
                SMK ICB CINTA TEKNIKA
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto space-x-4">
                <li class="nav-item <?php echo ($_SERVER['REQUEST_URI'] == '/' ? 'active' : ''); ?>">
                    <a class="nav-link text-lg text-black" href="/">Home</a>
                </li>
                <li class="nav-item <?php echo ($_SERVER['REQUEST_URI'] == '/informasi' ? 'active' : ''); ?>">
                    <a class="nav-link text-lg text-black" href="/informasi">Informasi</a>
                </li>
                <li class="nav-item <?php echo ($_SERVER['REQUEST_URI'] == '/galeri' ? 'active' : ''); ?>">
                    <a class="nav-link text-lg text-black" href="/galeri">Galeri</a>
                </li>
                <li class="nav-item <?php echo ($_SERVER['REQUEST_URI'] == '/data' ? 'active' : ''); ?>">
                    <a class="nav-link text-lg text-black" href="/data">Data</a>
                </li>
                <li class="nav-item <?php echo ($_SERVER['REQUEST_URI'] == '/biaya' ? 'active' : ''); ?>">
                    <a class="nav-link text-lg text-black" href="/biaya">Biaya Sekolah</a>
                </li>
                <li class="nav-item <?php echo ($_SERVER['REQUEST_URI'] == '/kontak' ? 'active' : ''); ?>">
                    <a class="nav-link text-lg text-black" href="/kontak">Kontak</a>
                </li>
                <li class="nav-item <?php echo ($_SERVER['REQUEST_URI'] == '/pendaftaran' ? 'active' : ''); ?>">
                    <a class="nav-link text-lg text-black" href="/pendaftaran">PPBD</a>
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
    <main class="container mt-4">
        <div class="main-content p-4 bg-white rounded shadow">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="text-center mt-4 py-4">
        <div class="container">
            <div class="row">
                <!-- Contact Info -->
                <div class="col-md-4 text-left">
                    <h3 class="text-light">Kontak</h3>
                    <ul class="list-unstyled text-light">
                        <li>📍 Jl. Atlas Tengah No.2, Babakan Surabaya, Kec. Kiaracondong, Kota Bandung, Jawa Barat 40281</li>
                        <li>📞 (022) 7234924</li>
                        <li>📧 icbcintateknika@gmail.com</li>
                    </ul>
                </div>

                <!-- Social Media Links -->
                <div class="col-md-4">
                    <h3 class="text-light">Ikuti Kami</h3>
                    <div class="mt-2">
                        <a href="#" class="text-light mx-1"><i class="fab fa-facebook-f fa-2x"></i></a>
                        <a href="https://www.instagram.com/smkicbcintateknika?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="text-light mx-1"><i class="fab fa-instagram fa-2x"></i></a>
                        <a href="#" class="text-light mx-1"><i class="fab fa-twitter fa-2x"></i></a>
                        <a href="https://youtu.be/l7n9k8Rzq3s?si=yoHf38XKqmHwY_p6" class="text-light mx-1"><i class="fab fa-youtube fa-2x"></i></a>
                    </div>
                </div>


                <!-- Quick Links -->
                <div class="col-md-4">
                    <h3 class="text-light">Tautan Cepat</h3>
                    <ul class="list-unstyled">
                        <li><a href="/data" class="text-light">Tentang Kami</a></li>
                        <li><a href="/kontak" class="text-light">Kontak Kami</a></li>
                        <li><a href="/berita" class="text-light">Berita</a></li>
                        <li><a href="/pendaftaran" class="text-light">Pendaftaran</a></li>
                    </ul>
                </div>
            </div>
            <p class="mt-4">&copy; 2024 <a href="https://ghdbh.hikji.org/" target="blank">GHDBH Squad.</a> All rights reserved.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @include('sweetalert::alert')
</body>

</html>
