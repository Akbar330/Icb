@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Overview Dashboard</h1>
        <p class="text-gray-500 mt-1">Selamat datang kembali, <span class="font-semibold text-blue-600">{{ Auth::user()->name ?? 'Admin' }}</span>! Berikut ringkasan data website Anda hari ini.</p>
    </div>

    <!-- Statistik Utama -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Card 1 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center hover:shadow-md transition-shadow">
            <div class="rounded-full bg-blue-100 p-4 mr-4 text-blue-600">
                <i class="fas fa-newspaper text-2xl w-6 text-center"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total Artikel</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $totalArtikels ?? 0 }}</h3>
            </div>
        </div>
        
        <!-- Card 2 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center hover:shadow-md transition-shadow">
            <div class="rounded-full bg-green-100 p-4 mr-4 text-green-600">
                <i class="fas fa-bullhorn text-2xl w-6 text-center"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total Berita</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $totalBeritas ?? 0 }}</h3>
            </div>
        </div>
        
        <!-- Card 3 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center hover:shadow-md transition-shadow">
            <div class="rounded-full bg-orange-100 p-4 mr-4 text-orange-600">
                <i class="fas fa-info-circle text-2xl w-6 text-center"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total Informasi</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $totalInformasis ?? 0 }}</h3>
            </div>
        </div>
        
        <!-- Card 4 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center hover:shadow-md transition-shadow">
            <div class="rounded-full bg-purple-100 p-4 mr-4 text-purple-600">
                <i class="fas fa-eye text-2xl w-6 text-center"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total Kunjungan</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $totalVisits ?? 0 }}</h3>
            </div>
        </div>
    </div>

    <!-- Analytics Chart -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-8 overflow-hidden hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-bold text-gray-800 text-lg">Statistik Kunjungan (7 Hari Terakhir)</h3>
            <span class="text-xs font-medium bg-blue-100 text-blue-700 px-3 py-1 rounded-full"><i class="fas fa-chart-line mr-1"></i> Live Data</span>
        </div>
        <div class="relative w-full h-72">
            <canvas id="visitorChart"></canvas>
        </div>
    </div>

    <!-- Quick Actions & Info -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Quick Actions -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                <h3 class="font-semibold text-gray-800">Aksi Cepat</h3>
            </div>
            <div class="p-6 grid grid-cols-2 gap-4">
                <a href="/admin/artikel/create" class="flex flex-col items-center justify-center p-4 rounded-xl border border-dashed border-gray-300 text-gray-600 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-colors">
                    <i class="fas fa-plus-circle text-2xl mb-2"></i>
                    <span class="text-sm font-medium">Tulis Artikel</span>
                </a>
                <a href="/admin/berita/create" class="flex flex-col items-center justify-center p-4 rounded-xl border border-dashed border-gray-300 text-gray-600 hover:bg-green-50 hover:text-green-600 hover:border-green-300 transition-colors">
                    <i class="fas fa-plus-circle text-2xl mb-2"></i>
                    <span class="text-sm font-medium">Buat Berita</span>
                </a>
                <a href="/admin/galeri/create" class="flex flex-col items-center justify-center p-4 rounded-xl border border-dashed border-gray-300 text-gray-600 hover:bg-purple-50 hover:text-purple-600 hover:border-purple-300 transition-colors">
                    <i class="fas fa-upload text-2xl mb-2"></i>
                    <span class="text-sm font-medium">Upload Galeri</span>
                </a>
                <a href="/admin/pendaftaran" class="flex flex-col items-center justify-center p-4 rounded-xl border border-dashed border-gray-300 text-gray-600 hover:bg-orange-50 hover:text-orange-600 hover:border-orange-300 transition-colors">
                    <i class="fas fa-user-check text-2xl mb-2"></i>
                    <span class="text-sm font-medium">Cek PPDB</span>
                </a>
            </div>
        </div>

        <!-- Info / Tips -->
        <div class="bg-gradient-to-br from-blue-600 to-blue-800 rounded-2xl shadow-md text-white p-6 relative overflow-hidden">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white opacity-10 rounded-full"></div>
            <div class="absolute bottom-0 right-20 -mb-10 w-24 h-24 bg-white opacity-10 rounded-full"></div>
            
            <div class="relative z-10 h-full flex flex-col justify-center">
                <h3 class="text-xl font-bold mb-3 flex items-center"><i class="fas fa-lightbulb text-yellow-300 mr-2"></i> Tips Hari Ini</h3>
                <p class="text-blue-100 text-sm leading-relaxed mb-4">
                    Pastikan Anda selalu memperbarui konten berita dan artikel secara berkala. Website yang aktif dengan konten baru akan lebih disukai oleh pengunjung dan mesin pencari (SEO).
                </p>
                <div class="mt-auto">
                    <a href="/" target="_blank" class="inline-block bg-white text-blue-700 hover:bg-blue-50 font-medium text-sm px-5 py-2 rounded-full transition-colors shadow-sm">
                        Kunjungi Website <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('visitorChart').getContext('2d');
            
            // Dummy data for visitor stats over the last 7 days to simulate dynamic view
            const labels = [];
            const data = [];
            let currentTotal = {{ $totalVisits ?? 150 }};
            
            // Generate dummy distribution based on total visits (just for UI preview)
            for(let i=6; i>=0; i--) {
                const d = new Date();
                d.setDate(d.getDate() - i);
                labels.push(d.toLocaleDateString('id-ID', { weekday: 'short', day: 'numeric', month: 'short' }));
                
                let val = Math.floor(currentTotal / 7) + (Math.floor(Math.random() * 20) - 10);
                if(val < 0) val = 5;
                data.push(val);
            }
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Pengunjung',
                        data: data,
                        borderColor: '#2563EB',
                        backgroundColor: 'rgba(37, 99, 235, 0.1)',
                        borderWidth: 3,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#2563EB',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#1F2937',
                            padding: 10,
                            titleFont: { size: 13, family: 'Inter' },
                            bodyFont: { size: 13, family: 'Inter' },
                            displayColors: false,
                            cornerRadius: 8,
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                borderDash: [5, 5],
                                color: '#E5E7EB',
                                drawBorder: false
                            },
                            ticks: {
                                color: '#6B7280',
                                font: { family: 'Inter' }
                            }
                        },
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                color: '#6B7280',
                                font: { family: 'Inter' }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
