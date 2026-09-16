<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - SMK ICB CT')</title>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Tailwind CSS (via Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f3f4f6; }
        
        /* Sidebar Styles */
        .sidebar {
            transition: transform 0.3s ease-in-out;
            width: 260px;
        }
        .sidebar-link {
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }
        .sidebar-link:hover, .sidebar-link.active {
            background-color: #1e3a8a; /* blue-900 */
            border-left-color: #60a5fa; /* blue-400 */
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); position: fixed; z-index: 50; }
            .sidebar.open { transform: translateX(0); }
            .content-area { margin-left: 0 !important; }
            .overlay { display: none; }
            .overlay.open { display: block; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 40; }
        }
    </style>
</head>
<body class="text-gray-800 antialiased overflow-x-hidden flex h-screen">

    <!-- Mobile Overlay -->
    <div id="sidebarOverlay" class="overlay"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar bg-blue-800 text-white flex-shrink-0 h-full overflow-y-auto z-50 md:relative fixed">
        <div class="p-5 flex items-center justify-between border-b border-blue-700">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('icb.png') }}" alt="Logo" class="h-10 w-10 bg-white rounded-full p-1">
                <div>
                    <h2 class="text-sm font-bold tracking-wider">SMK ICB CT</h2>
                    <p class="text-xs text-blue-300">Admin Panel</p>
                </div>
            </div>
            <!-- Mobile Close Button -->
            <button id="closeSidebar" class="md:hidden text-blue-200 hover:text-white">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <nav class="mt-5 mb-10">
            @if(Auth::user()->role === 'eskul')
                <p class="px-5 text-xs font-semibold text-blue-300 uppercase tracking-wider mb-2">Panel Eskul</p>
                <ul class="space-y-1">
                    @if(Auth::user()->eskul_id)
                        <li><a href="/admin/eskul/{{ Auth::user()->eskul_id }}/edit" class="sidebar-link flex items-center px-5 py-3 text-sm {{ request()->is('admin/eskul*') ? 'active' : '' }}"><i class="fas fa-id-card w-6 text-center mr-2"></i> Profil Eskul Saya</a></li>
                    @endif
                    <li><a href="/admin/kegiatan-eskul" class="sidebar-link flex items-center px-5 py-3 text-sm {{ request()->is('admin/kegiatan-eskul*') ? 'active' : '' }}"><i class="fas fa-newspaper w-6 text-center mr-2"></i> Berita & Kegiatan</a></li>
                    <li><a href="/eskul/{{ Auth::user()->eskul ? Auth::user()->eskul->slug : '' }}" target="_blank" class="sidebar-link flex items-center px-5 py-3 text-sm"><i class="fas fa-external-link-alt w-6 text-center mr-2"></i> Lihat Eskul di Web</a></li>
                </ul>
            @else
                <p class="px-5 text-xs font-semibold text-blue-300 uppercase tracking-wider mb-2">Menu Utama</p>
                <ul class="space-y-1">
                    <li><a href="/admin" class="sidebar-link flex items-center px-5 py-3 text-sm {{ request()->is('admin') ? 'active' : '' }}"><i class="fas fa-tachometer-alt w-6 text-center mr-2"></i> Dashboard</a></li>
                    <li><a href="/admin/eskul" class="sidebar-link flex items-center px-5 py-3 text-sm {{ request()->is('admin/eskul*') ? 'active' : '' }}"><i class="fas fa-trophy w-6 text-center mr-2"></i> Ekstrakurikuler</a></li>
                    <li><a href="/admin/kegiatan-eskul" class="sidebar-link flex items-center px-5 py-3 text-sm {{ request()->is('admin/kegiatan-eskul*') ? 'active' : '' }}"><i class="fas fa-calendar-alt w-6 text-center mr-2"></i> Kegiatan Eskul</a></li>
                    <li><a href="/admin/artikel" class="sidebar-link flex items-center px-5 py-3 text-sm {{ request()->is('admin/artikel*') ? 'active' : '' }}"><i class="fas fa-newspaper w-6 text-center mr-2"></i> Artikel</a></li>
                    <li><a href="/admin/berita" class="sidebar-link flex items-center px-5 py-3 text-sm {{ request()->is('admin/berita*') ? 'active' : '' }}"><i class="fas fa-bullhorn w-6 text-center mr-2"></i> Berita</a></li>
                    <li><a href="/admin/informasi" class="sidebar-link flex items-center px-5 py-3 text-sm {{ request()->is('admin/informasi*') ? 'active' : '' }}"><i class="fas fa-info-circle w-6 text-center mr-2"></i> Informasi</a></li>
                    <li><a href="/admin/galeri" class="sidebar-link flex items-center px-5 py-3 text-sm {{ request()->is('admin/galeri*') ? 'active' : '' }}"><i class="fas fa-images w-6 text-center mr-2"></i> Galeri (Lama)</a></li>
                </ul>

                <p class="px-5 text-xs font-semibold text-blue-300 uppercase tracking-wider mt-6 mb-2">Konten Spesifik</p>
                <ul class="space-y-1">
                    <li><a href="/admin/carousel" class="sidebar-link flex items-center px-5 py-3 text-sm {{ request()->is('admin/carousel*') ? 'active' : '' }}"><i class="fas fa-image w-6 text-center mr-2"></i> Banner (Carousel)</a></li>
                    <li><a href="/admin/oncam" class="sidebar-link flex items-center px-5 py-3 text-sm {{ request()->is('admin/oncam*') ? 'active' : '' }}"><i class="fab fa-youtube w-6 text-center mr-2"></i> Video YouTube</a></li>
                    <li><a href="/admin/sapaan" class="sidebar-link flex items-center px-5 py-3 text-sm {{ request()->is('admin/sapaan*') ? 'active' : '' }}"><i class="fas fa-comment-dots w-6 text-center mr-2"></i> Sapaan Kepsek</a></li>
                </ul>

                <p class="px-5 text-xs font-semibold text-blue-300 uppercase tracking-wider mt-6 mb-2">Manajemen Profil</p>
                <ul class="space-y-1">
                    <li><a href="/admin/visi" class="sidebar-link flex items-center px-5 py-3 text-sm {{ request()->is('admin/visi*') ? 'active' : '' }}"><i class="fas fa-eye w-6 text-center mr-2"></i> Visi & Misi</a></li>
                    <li><a href="/admin/biaya" class="sidebar-link flex items-center px-5 py-3 text-sm {{ request()->is('admin/biaya*') ? 'active' : '' }}"><i class="fas fa-money-bill-wave w-6 text-center mr-2"></i> Biaya Sekolah</a></li>
                    <li><a href="/admin/pendaftaran" class="sidebar-link flex items-center px-5 py-3 text-sm {{ request()->is('admin/pendaftaran*') ? 'active' : '' }}"><i class="fas fa-user-plus w-6 text-center mr-2"></i> Data PPDB</a></li>
                    <li><a href="/admin/polling" class="sidebar-link flex items-center px-5 py-3 text-sm {{ request()->is('admin/polling*') ? 'active' : '' }}"><i class="fas fa-poll w-6 text-center mr-2"></i> Polling Web</a></li>
                </ul>

                <p class="px-5 text-xs font-semibold text-blue-300 uppercase tracking-wider mt-6 mb-2">Sistem</p>
                <ul class="space-y-1">
                    <li><a href="/admin/pengguna" class="sidebar-link flex items-center px-5 py-3 text-sm {{ request()->is('admin/pengguna*') ? 'active' : '' }}"><i class="fas fa-users w-6 text-center mr-2"></i> Pengguna (User)</a></li>
                </ul>
            @endif
        </nav>
    </aside>

    <!-- Main Wrapper -->
    <div class="flex-1 flex flex-col h-full w-full overflow-hidden bg-gray-50 content-area">
        <!-- Top Header -->
        <header class="bg-white shadow-sm z-30 h-16 flex items-center justify-between px-5 sm:px-8 border-b border-gray-200 flex-shrink-0">
            <!-- Left: Mobile Toggle -->
            <button id="openSidebar" class="md:hidden text-gray-500 hover:text-blue-600 focus:outline-none">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <div class="hidden md:block">
                <h3 class="text-gray-700 font-semibold text-lg">@yield('title', 'Admin Dashboard')</h3>
            </div>

            <!-- Right: User Menu -->
            <div class="flex items-center space-x-4">
                <a href="/" target="_blank" class="text-sm text-blue-600 hover:text-blue-800 font-medium hidden sm:flex items-center">
                    <i class="fas fa-external-link-alt mr-2"></i> Lihat Website
                </a>
                <div class="h-6 w-px bg-gray-300 hidden sm:block"></div>
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold border border-blue-200">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </div>
                    <div class="hidden sm:block text-left">
                        <span class="text-sm font-medium text-gray-700 block leading-tight">{{ Auth::user()->name ?? 'Administrator' }}</span>
                        <span class="text-[10px] text-gray-400 font-semibold uppercase">
                            @if(Auth::user()->role === 'eskul')
                                Pengurus {{ Auth::user()->eskul ? Auth::user()->eskul->nama_eskul : 'Eskul' }}
                            @else
                                Super Admin
                            @endif
                        </span>
                    </div>
                </div>
                <!-- Logout Button -->
                <form action="{{ route('logout') }}" method="POST" class="m-0 pl-2 ml-2 border-l border-gray-200">
                    @csrf
                    <button type="submit" class="text-gray-500 hover:text-red-600 transition-colors" title="Logout">
                        <i class="fas fa-sign-out-alt text-lg"></i>
                    </button>
                </form>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-5 sm:p-8">
            @yield('content')
            
            <footer class="mt-10 pt-5 border-t border-gray-200 text-center text-sm text-gray-500">
                <p>&copy; {{ date('Y') }} Reworked by Ndraw. All rights reserved.</p>
            </footer>
        </main>
    </div>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const openBtn = document.getElementById('openSidebar');
            const closeBtn = document.getElementById('closeSidebar');
            const overlay = document.getElementById('sidebarOverlay');

            function toggleSidebar() {
                sidebar.classList.toggle('open');
                overlay.classList.toggle('open');
            }

            if(openBtn) openBtn.addEventListener('click', toggleSidebar);
            if(closeBtn) closeBtn.addEventListener('click', toggleSidebar);
            if(overlay) overlay.addEventListener('click', toggleSidebar);
        });
    </script>
    
    @include('sweetalert::alert')
    @yield('scripts')
</body>
</html>
