<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SMK ICB CT')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @vite(['resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F9FAFB;
            color: #333;
            margin-top: 60px;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: white;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 5px 0;
        }

        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav .navbar-collapse {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        nav a {
            padding: 6px 10px;
            text-transform: uppercase;
            font-weight: 500;
            color: black;
            font-size: 0.75rem;
            transition: color 0.3s, border-bottom 0.3s;
        }

        nav a:hover,
        nav a.active {
            color: #000000;
            border-bottom: 2px solid #000000;
        }

        @media (max-width: 768px) {
            nav .navbar-toggler {
                display: inline-block;
            }

            nav a {
                display: block;
                padding: 8px 10px;
            }

            nav .navbar-collapse {
                background-color: white;
                position: absolute;
                top: 100%;
                left: 0;
                width: 100%;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                padding: 10px;
                display: none;
            }

            nav .navbar-collapse.show {
                display: block;
            }
        }

        @media (min-width: 769px) {
            nav .navbar-toggler {
                display: none;
            }

            nav .navbar-collapse {
                display: flex;
                justify-content: space-between;
            }

            nav a {
                padding: 6px 12px;
            }
        }
    </style>
</head>

<body>
    <!-- Header with Navigation -->
    <header>
        <div class="container mx-auto px-4 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('icb.png') }}" alt="Logo" class="h-12 w-auto">
                <div>
                    <h1>ADMIN DASHBOARD SMK ICB CINTA TEKNIKA</h1>
                    <p>Admin Page</p>
                </div>
            </div>
            <nav class="navbar">
                <button class="navbar-toggler" type="button">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="navbar-collapse" id="navbarNav">
                    <a href="/admin" class="{{ request()->is('admin') ? 'active' : '' }}">Home</a>
                    <a href="/admin/artikel" class="{{ request()->is('admin/artikel') ? 'active' : '' }}">Artikel</a>
                    <a href="/admin/berita" class="{{ request()->is('admin/berita') ? 'active' : '' }}">Berita</a>
                    <a href="/admin/galeri" class="{{ request()->is('admin/galeri') ? 'active' : '' }}">Galeri</a>
                    <a href="/admin/informasi" class="{{ request()->is('admin/informasi') ? 'active' : '' }}">Informasi</a>
                    <a href="/admin/carousel" class="{{ request()->is('admin/carousel') ? 'active' : '' }}">Banner</a>
                    <a href="/admin/oncam" class="{{ request()->is('admin/oncam') ? 'active' : '' }}">Youtube</a>
                    <a href="/admin/sapaan" class="{{ request()->is('admin/sapaan') ? 'active' : '' }}">Sapaan</a>
                    <a href="/admin/pendaftaran" class="{{ request()->is('admin/pendaftaran') ? 'active' : '' }}">PPDB</a>
                    <a href="/admin/biaya" class="{{ request()->is('admin/biaya') ? 'active' : '' }}">Biaya</a>
                    <a href="/admin/pengguna" class="{{ request()->is('admin/pengguna') ? 'active' : '' }}">User</a>
                    <a href="/admin/visi" class="{{ request()->is('admin/visi') ? 'active' : '' }}">Visi-Misi</a>
                    <a href="/admin/polling" class="{{ request()->is('admin/polling') ? 'active' : '' }}">Polling</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-black hover:text-gray-600 flex items-center space-x-2 font-bold">
                            Logout
                        </button>
                    </form>
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto  px-4">
        <div class="main-content" style="margin-top: 100px">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 text-center py-6 mt-10">
        <p>&copy; 2024 SMK ICB CT. All rights reserved.</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggler = document.querySelector('.navbar-toggler');
            const collapse = document.querySelector('.navbar-collapse');

            toggler.addEventListener('click', function () {
                collapse.classList.toggle('show');
            });

            // Menambahkan active class pada menu yang dipilih
            const links = document.querySelectorAll('.navbar-collapse a');
            links.forEach(link => {
                link.addEventListener('click', function () {
                    links.forEach(link => link.classList.remove('active'));
                    link.classList.add('active');
                });
            });
        });
    </script>
    @include('sweetalert::alert')

</body>

</html>
