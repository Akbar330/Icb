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
}

/* Navigation */
nav a {
    position: relative;
    padding: 8px 0; /* Reduced padding */
    text-transform: uppercase;
    font-weight: 600;
    color: #E2E8F0;
    font-size: 0.875rem; /* Smaller font size */
    transition: color 0.3s, border-bottom 0.3s;
}

nav a:hover,
nav a.active {
    color: #F1C40F;
    border-bottom: 2px solid #F1C40F;
}

/* Header */
header {
    background: linear-gradient(to right, #1E3A8A, #F1C40F);
    padding: 10px 0; /* Reduced padding */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

header .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

header h1 {
    font-size: 1.25rem; /* Smaller font size */
    color: white;
}

header p {
    font-size: 0.75rem; /* Smaller font size */
    color: white;
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
                <img src="{{ asset('storage/icb.png') }}" alt="Logo" class="h-12 w-auto">
                <div>
                    <h1>SMK ICB CINTA TEKNIKA</h1>
                    <p>Tempat di mana pendidikan berkualitas menjadi prioritas kami</p>
                </div>
            </div>
            <nav class="flex space-x-6 ml-auto">
                <a href="/" class="text-white">Home</a>
                <a href="/visi-misi" class="text-white">Visi-Misi</a>
                <a href="/informasi" class="text-white">Informasi</a>
                <a href="/galeri" class="text-white">Galeri</a>
                <a href="/data" class="text-white">Data</a>
                <a href="/kontak" class="text-white">Kontak</a>
                <a href="/artikel" class="text-white">Artikel</a>
                <a href="/berita" class="text-white">Berita</a>
                <a href="/pendaftaran" class="text-white">Pendaftaran</a>
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
            <div>
                <h3 class="text-xl font-semibold mb-4">Kontak</h3>
                <ul class="space-y-2">
                    <li>📍 Alamat: Jalan Raya No. 123, Jakarta</li>
                    <li>📞 Telepon: (021) 123-4567</li>
                    <li>📧 Email: info@smkicbct.com</li>
                </ul>
            </div>

            <!-- Social Media Links -->
            <div>
                <h3 class="text-xl font-semibold mb-4">Ikuti Kami</h3>
                    <a href="#" class="text-blue-400 hover:text-blue-600 mx-3"><i class="fab fa-facebook-f fa-2x"></i></a>
                    <a href="#" class="text-blue-400 hover:text-blue-600 mx-3"><i class="fab fa-instagram fa-2x"></i></a>
                    <a href="#" class="text-blue-400 hover:text-blue-600 mx-3"><i class="fab fa-twitter fa-2x"></i></a>
                    <a href="#" class="text-blue-400 hover:text-blue-600 mx-3"><i class="fab fa-linkedin-in fa-2x"></i></a>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-xl font-semibold mb-4">Tautan Cepat</h3>
                <ul class="space-y-2">
                    <a href="/tentang" class="hover:text-yellow-200">Tentang Kami</a></li>
                    <li><a href="/kontak" class="hover:text-yellow-200">Kontak Kami</a></li>
                    <li><a href="/berita" class="hover:text-yellow-200">Berita</a></li>
                    <li><a href="/pendaftaran" class="hover:text-yellow-200">Pendaftaran</a></li>
                </ul>
            </div>
        </div>

        <p>&copy; 2024 SMK ICB CT. All rights reserved.</p>
    </footer>

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
