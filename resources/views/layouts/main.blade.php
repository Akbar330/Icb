<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SMK ICB CT')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
            padding-bottom: 5px;
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
    </style>
</head>

<body class="font-sans bg-gray-100 text-gray-800">

    @yield('scripts')
    <!-- Loading Bar -->
    <div id="loading-bar"></div>
    <header class="bg-blue-900 py-2 shadow-lg relative" id="header">
        <div class="container mx-auto flex items-center justify-between">
            <!-- Bagian kiri: "NEWS UPDATE" -->
            <h1 class="text-xl font-bold text-white">NEWS UPDATE:</h1>

            <!-- Bagian kanan: Waktu dan Tanggal -->
            <div class="absolute top-0 right-0 z-30 w-full max-w-lg">
                <div class="bg-black bg-opacity-90 text-white px-8 py-4 transform skew-x-12 w-full">
                    <p id="datetime" class="transform -skew-x-12 text-sm"></p>
                </div>
            </div>

            <!-- Bagian untuk judul berita yang bergerak -->
            <div class="overflow-hidden flex-grow max-w-full ml-8">
                <ul class="marquee-list flex space-x-12"> <!-- Menambahkan jarak antar judul -->
                    @foreach ($beritas as $berita)
                        <li class="text-lg marquee-item">
                            <a href="{{ route('berita.show', $berita->id) }}" class="text-white hover:underline">
                                {{ $berita->judul }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </header>

    <script>
        // Fungsi untuk memperbarui tanggal dan waktu
        function updateDateTime() {
            const now = new Date();
            const options = {
                weekday: 'long', year: 'numeric', month: 'long', day: 'numeric',
                hour: '2-digit', minute: '2-digit', second: '2-digit'
            };
            document.getElementById('datetime').textContent = now.toLocaleDateString('id-ID', options);
        }

        // Jalankan fungsi saat halaman dimuat dan setiap detik
        document.addEventListener('DOMContentLoaded', () => {
            updateDateTime();
            setInterval(updateDateTime, 1000);
        });
    </script>

    <style>
        /* Set untuk judul-judul yang berjalan */
        .marquee-list {
            display: flex;
            animation: marquee 15s linear infinite;  /* Atur durasi animasi */
        }

        /* Set animasi marquee */
        @keyframes marquee {
            0% {
                transform: translateX(-100%);
            }
            100% {
                transform: translateX(100%);
            }
        }

        /* Menambahkan penundaan untuk setiap item supaya tampil bergantian */
        .marquee-item {
            opacity: 0;
            animation: fadeIn 12s linear infinite;  /* Durasi lebih lama agar animasi lambat */
        }

        /* Animasi untuk munculnya judul */
        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            30% {
                opacity: 1;
            }
            50% {
                opacity: 0;
            }
        }

        /* Penundaan untuk setiap item agar tampil bergantian */
        .marquee-item:nth-child(1) {
            animation-delay: 0s;
        }

        .marquee-item:nth-child(2) {
            animation-delay: 2s;
        }

        .marquee-item:nth-child(3) {
            animation-delay: 4s;
        }

        .marquee-item:nth-child(4) {
            animation-delay: 6s;
        }

        .marquee-item:nth-child(5) {
            animation-delay: 8s;
        }

        .marquee-item:nth-child(6) {
            animation-delay: 10s;
        }

        /* Perbesar ukuran font untuk judul */
        .marquee-item a {
            font-size: 1.5rem; /* Ukuran font yang lebih besar */
        }
    </style>





<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white py-4 shadow-md z-10" id="navbar">
    <div class="container">
        <div class="navbar-logo">
            <img src="{{ asset('icb.png') }}" alt="Logo SMK ICB Cinta Technika" class="h-10 w-10">
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
                <li class="nav-item <?php echo ($_SERVER['REQUEST_URI'] == '/visi-misi' ? 'active' : ''); ?>">
                    <a class="nav-link text-lg text-black" href="/visi-misi">Visi-Misi</a>
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
                <li class="nav-item <?php echo ($_SERVER['REQUEST_URI'] == '/kontak' ? 'active' : ''); ?>">
                    <a class="nav-link text-lg text-black" href="/kontak">Kontak</a>
                </li>
                <li class="nav-item <?php echo ($_SERVER['REQUEST_URI'] == '/artikel' ? 'active' : ''); ?>">
                    <a class="nav-link text-lg text-black" href="/artikel">Artikel</a>
                </li>
                <li class="nav-item <?php echo ($_SERVER['REQUEST_URI'] == '/berita' ? 'active' : ''); ?>">
                    <a class="nav-link text-lg text-black" href="/berita">Berita</a>
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
                        <a href="#" class="text-light mx-1"><i class="fab fa-instagram fa-2x"></i></a>
                        <a href="#" class="text-light mx-1"><i class="fab fa-twitter fa-2x"></i></a>
                        <a href="#" class="text-light mx-1"><i class="fab fa-linkedin-in fa-2x"></i></a>
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
            <p class="mt-4">&copy; 2024 SMK ICB CT. All rights reserved.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
