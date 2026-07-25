@extends('layouts.main')

@section('title', 'Kontak')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <div class="text-center mb-10">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800">Hubungi Kami</h1>
            <div class="w-20 h-1.5 bg-blue-600 mx-auto mt-4 rounded-full"></div>
            <p class="text-gray-500 mt-4 text-lg">Jangan ragu untuk menghubungi kami jika ada pertanyaan atau informasi lebih lanjut.</p>
        </div>

        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover-card">
            <div class="flex flex-col md:flex-row">
                <!-- Bagian Kiri (Info Kontak) -->
                <div class="bg-blue-600 text-white p-8 md:p-10 md:w-1/2 flex flex-col justify-center relative overflow-hidden">
                    <!-- Hiasan Background -->
                    <div class="absolute -top-16 -left-16 w-32 h-32 bg-white opacity-10 rounded-full"></div>
                    <div class="absolute -bottom-24 -right-24 w-64 h-64 bg-white opacity-10 rounded-full"></div>
                    
                    <h2 class="text-2xl font-bold mb-6 relative z-10">Informasi Kontak</h2>
                    
                    <ul class="space-y-6 relative z-10">
                        <li class="flex items-start">
                            <i class="fas fa-envelope mt-1.5 mr-4 text-xl opacity-80 w-6 text-center"></i>
                            <div>
                                <p class="font-semibold text-sm opacity-80 mb-1">Email</p>
                                <p class="text-base md:text-lg break-all">icbcintateknika@gmail.com</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone-alt mt-1.5 mr-4 text-xl opacity-80 w-6 text-center"></i>
                            <div>
                                <p class="font-semibold text-sm opacity-80 mb-1">Telepon</p>
                                <p class="text-base md:text-lg break-words">(022) 7234924</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1.5 mr-4 text-xl opacity-80 w-6 text-center"></i>
                            <div class="w-full">
                                <p class="font-semibold text-sm opacity-80 mb-1">Alamat Lengkap</p>
                                <p class="leading-relaxed text-sm md:text-base break-words">Jl. Atlas Tengah No.2, Babakan Surabaya, Kec. Kiaracondong, Kota Bandung, Jawa Barat 40281</p>
                            </div>
                        </li>
                    </ul>
                </div>
                
                <!-- Bagian Kanan (Gambar/Peta/Ilustrasi) -->
                <div class="p-8 md:p-10 md:w-1/2 bg-gray-50 flex items-center justify-center">
                    <div class="text-center">
                        <i class="fas fa-headset text-7xl text-blue-300 mb-6 drop-shadow-md"></i>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Layanan Cepat</h3>
                        <p class="text-gray-500 text-sm">Kami siap merespons pertanyaan Anda pada hari dan jam kerja (Senin - Jumat, 08.00 - 15.00 WIB).</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
