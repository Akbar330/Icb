<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ICB | CONTENT MANAGEMENT SYSTEM</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900 bg-gray-100 relative h-screen overflow-y-auto flex flex-col justify-center items-center">
    
    <!-- Background Image with Overlay -->
    <div class="fixed inset-0 z-0">
        <img src="{{ asset('loginbg.jpg') }}" alt="Background" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-blue-900/60 backdrop-blur-sm mix-blend-multiply"></div>
    </div>

    <!-- Main Wrapper -->
    <div class="relative z-10 w-full max-w-md px-4 py-4 flex flex-col items-center">
        <!-- Logo -->
        <div class="mb-4 transform hover:scale-105 transition-transform duration-300">
            <a href="/" wire:navigate>
                <img src="{{ asset('icb.png') }}" alt="Logo SMK ICB" class="w-24 h-24 drop-shadow-2xl">
            </a>
        </div>
    
        <!-- Slot Container (Form) -->
        <div class="w-full bg-white/90 backdrop-blur-md shadow-2xl rounded-2xl p-6 sm:p-8 border border-white/50">
            {{ $slot }}
        </div>
        
        <!-- Footer links or copyright can go here -->
        <div class="mt-4 text-center text-white/70 text-xs font-medium">
            &copy; {{ date('Y') }} Reworked by Ndraw. Hak Cipta Dilindungi.
        </div>
    </div>
</body>
</html>
