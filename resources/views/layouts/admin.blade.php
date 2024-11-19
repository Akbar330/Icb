<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SMK ICB CT')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F9FAFB;
            color: #333;
            margin-top: 80px; /* Adjust according to your header height */

        }

        /* Navigation */
        nav a {
            position: relative;
            padding: 8px 0; /* Reduced padding */
            text-transform: uppercase;
            font-weight: 600;
            color: #black;
            font-size: 0.875rem; /* Smaller font size */
            transition: color 0.3s, border-bottom 0.3s;
        }

        nav a:hover,
        nav a.active {
            color: #000000;
            border-bottom: 2px solid #000000;
        }

        /* Header */
/* Make the whole header fixed at the top */
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: white; /* Ensure the header has a background */
            z-index: 1000; /* Keeps the header above other content */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Optional: Adds shadow for better visibility */
            padding: 10px 0; /* Adjust padding */
        }



        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            font-size: 1.25rem; /* Smaller font size */
            color: black;
        }

        header p {
            font-size: 0.75rem; /* Smaller font size */
            color: black;
        }

        header img {
            height: 35px; /* Smaller logo size */
        }

        /* Main Content */
        .main-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px; /* Add a top margin so the content is not hidden behind the fixed header */

        }

        /* Footer */
        footer {
            background-color: #2D3748;
            padding: 15px 0;
            color: #CBD5E0;
        }

        footer a {
            color: #CBD5E0;
            font-size: 0.875rem; /* Smaller font size */
            transition: color 0.3s;
        }

        footer a:hover {
            color: #F1C40F;
        }

        /* Buttons */
        .btn {
            display: inline-block;
            padding: 8px 18px;
            background-color: #F1C40F;
            color: white;
            font-weight: 600;
            font-size: 0.875rem; /* Smaller font size */
            border-radius: 6px;
            text-transform: uppercase;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #D39A00;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            header .container {
                flex-direction: column;
                text-align: center;
            }

            nav {
                margin-top: 10px;
            }

            nav a {
                display: inline-block;
                margin: 0 10px;
            }
        }

    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>

    <!-- Header with Navigation -->
    <header class="bg-transparent">
        <div class="container mx-auto px-4 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('icb.png') }}" alt="Logo" class="h-12 w-auto">
                <div>
                    <h1>ADMIN DASHBOARD SMK ICB CINTA TEKNIKA</h1>
                    <p>Admin Page</p>
                </div>
            </div>
            <nav class="flex space-x-6 ml-auto items-center">
                <a href="/admin" class="text-black">Home</a>
                <a href="/admin/artikel" class="text-black">Artikel</a>
                <a href="/admin/berita" class="text-black">Berita</a>
                <a href="/admin/galeri" class="text-black">Galeri</a>
                <a href="/admin/informasi" class="text-black">Informasi</a>
                <a href="/admin/carousel" class="text-black">Carousel</a>
                <a href="/admin/pendaftaran" class="text-black">PPDB</a>

                <!-- Tombol Logout -->
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-black hover:text-gray-600 flex items-center space-x-2 font-bold">
                        <span>Logout</span>
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </nav>


        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto mt-10 px-4">
        <div class="main-content">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 text-center py-6 mt-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Contact Info -->

        </div>

        <p>&copy; 2024 SMK ICB CT. All rights reserved.</p>
    </footer>
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->

    <script>
        // JavaScript to add active class to the clicked link in the navigation
        // Add active class to the current page link based on the current URL
        document.addEventListener('DOMContentLoaded', function () {
            const navLinks = document.querySelectorAll('nav a');
            navLinks.forEach(link => {
                if (window.location.pathname === link.getAttribute('href')) {
                    link.classList.add('active');
                }
                link.addEventListener('click', function () {
                    navLinks.forEach(link => link.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>
</body>

</html>
