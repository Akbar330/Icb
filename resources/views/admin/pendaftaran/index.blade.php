@extends('layouts.admin')

@section('title', 'Data Pendaftar PPDB')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Data Pendaftar</h1>
        <p class="text-sm text-gray-500 mt-1">Berikut adalah data pendaftar yang telah melakukan registrasi.</p>
    </div>
    <div class="flex gap-2">
        <a href="{{ route('admin.pendaftaran.exportExcel') }}" class="inline-flex items-center bg-green-600 text-white font-semibold py-2 px-4 rounded-lg shadow-sm hover:bg-green-700 hover:shadow-md transition-all text-sm">
            <i class="fas fa-file-excel mr-2"></i> Export Excel
        </a>
    </div>
</div>

<!-- Chart Section -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-8">
    <div class="p-5 border-b border-gray-100 bg-gray-50/50">
        <h2 class="font-semibold text-gray-700">Statistik Pendaftar Berdasarkan Jurusan dan Jenis Kelamin</h2>
    </div>
    <div class="p-5">
        <div class="relative w-full h-[300px] flex items-center justify-center">
            <canvas id="pendaftarChart" class="w-full h-full"></canvas>
        </div>
    </div>
</div>

<!-- Data Section -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <!-- Toolbar -->
    <div class="p-5 border-b border-gray-100 bg-gray-50/50 flex flex-col sm:flex-row justify-between items-center gap-4">
        <h2 class="font-semibold text-gray-700">Daftar Lengkap</h2>
        <div class="relative w-full sm:w-72">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400"></i>
            </div>
            <input type="text" id="search" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Cari data pendaftar...">
        </div>
    </div>

    <div class="p-5 bg-gray-50/30">
        <!-- Card Section for Pendaftar -->
        <div id="pendaftarCards" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @forelse ($pendaftarans as $pendaftaran_item)
                <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow relative">
                    <div class="absolute top-4 right-4 bg-blue-100 text-blue-700 text-xs font-bold px-2 py-1 rounded">
                        {{ $pendaftaran_item->jalur_pendaftaran }}
                    </div>
                    
                    <h3 class="text-lg font-bold text-gray-800 mb-1 pr-16">{{ ucwords($pendaftaran_item->nama_siswa) }}</h3>
                    <p class="text-sm font-medium text-blue-600 mb-4">{{ $pendaftaran_item->jurusan }}</p>
                    
                    <div class="grid grid-cols-2 gap-y-2 text-sm text-gray-600 mb-5">
                        <div>
                            <span class="block text-xs text-gray-400 uppercase tracking-wider mb-0.5">NISN / NIS</span>
                            <span class="font-medium text-gray-700">{{ $pendaftaran_item->nis ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="block text-xs text-gray-400 uppercase tracking-wider mb-0.5">Asal Sekolah</span>
                            <span class="font-medium text-gray-700 truncate block" title="{{ $pendaftaran_item->asal_sekolah }}">{{ $pendaftaran_item->asal_sekolah ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="block text-xs text-gray-400 uppercase tracking-wider mb-0.5">L/P</span>
                            <span class="font-medium text-gray-700">{{ $pendaftaran_item->jenis_kelamin }}</span>
                        </div>
                        <div>
                            <span class="block text-xs text-gray-400 uppercase tracking-wider mb-0.5">No. HP</span>
                            <span class="font-medium text-gray-700">{{ $pendaftaran_item->no_hp ?? '-' }}</span>
                        </div>
                    </div>
                    
                    <div class="pt-4 border-t border-gray-100 mt-auto">
                        <a href="{{ route('admin.pendaftaran.show', $pendaftaran_item->id) }}" class="block w-full text-center bg-gray-50 hover:bg-blue-50 text-gray-600 hover:text-blue-600 font-medium py-2 rounded-lg text-sm transition-colors border border-gray-200 hover:border-blue-200">
                            <i class="fas fa-id-card mr-1.5"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white p-8 rounded-xl border border-dashed border-gray-300 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                        <i class="fas fa-users-slash text-2xl text-gray-400"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">Data Kosong</h3>
                    <p class="text-gray-500">Belum ada data pendaftar yang masuk ke sistem.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Live Search
    $('#search').on('keyup', function() {
        let query = $(this).val();
        $.ajax({
            url: "{{ route('admin.pendaftaran.search') }}",
            type: "GET",
            data: {
                query
            },
            success: function(data) {
                let cards = '';
                if(data.length === 0){
                    cards = `
                    <div class="col-span-full bg-white p-8 rounded-xl border border-dashed border-gray-300 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                            <i class="fas fa-search text-2xl text-gray-400"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-1">Pencarian Tidak Ditemukan</h3>
                        <p class="text-gray-500">Tidak ada pendaftar yang cocok dengan kata kunci tersebut.</p>
                    </div>`;
                } else {
                    data.forEach(item => {
                        let nama = item.nama_siswa ? item.nama_siswa.toLowerCase().replace(/\b\w/g, s => s.toUpperCase()) : '';
                        cards += `
                        <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow relative">
                            <div class="absolute top-4 right-4 bg-blue-100 text-blue-700 text-xs font-bold px-2 py-1 rounded">
                                ${item.jalur_pendaftaran || '-'}
                            </div>
                            
                            <h3 class="text-lg font-bold text-gray-800 mb-1 pr-16">${nama}</h3>
                            <p class="text-sm font-medium text-blue-600 mb-4">${item.jurusan || '-'}</p>
                            
                            <div class="grid grid-cols-2 gap-y-2 text-sm text-gray-600 mb-5">
                                <div>
                                    <span class="block text-xs text-gray-400 uppercase tracking-wider mb-0.5">NISN / NIS</span>
                                    <span class="font-medium text-gray-700">${item.nis || '-'}</span>
                                </div>
                                <div>
                                    <span class="block text-xs text-gray-400 uppercase tracking-wider mb-0.5">Asal Sekolah</span>
                                    <span class="font-medium text-gray-700 truncate block" title="${item.asal_sekolah || '-'}">${item.asal_sekolah || '-'}</span>
                                </div>
                                <div>
                                    <span class="block text-xs text-gray-400 uppercase tracking-wider mb-0.5">L/P</span>
                                    <span class="font-medium text-gray-700">${item.jenis_kelamin || '-'}</span>
                                </div>
                                <div>
                                    <span class="block text-xs text-gray-400 uppercase tracking-wider mb-0.5">No. HP</span>
                                    <span class="font-medium text-gray-700">${item.no_hp || '-'}</span>
                                </div>
                            </div>
                            
                            <div class="pt-4 border-t border-gray-100 mt-auto">
                                <a href="/admin/pendaftaran/${item.id}" class="block w-full text-center bg-gray-50 hover:bg-blue-50 text-gray-600 hover:text-blue-600 font-medium py-2 rounded-lg text-sm transition-colors border border-gray-200 hover:border-blue-200">
                                    <i class="fas fa-id-card mr-1.5"></i> Lihat Detail
                                </a>
                            </div>
                        </div>`;
                    });
                }
                $('#pendaftarCards').html(cards);
            }
        });
    });

    // Chart.js
    const chartData = @json($chartData);
    const labels = chartData.map(item => item.jurusan);
    const maleData = chartData.map(item => item.total_male);
    const femaleData = chartData.map(item => item.total_female);

    new Chart(document.getElementById("pendaftarChart"), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                    label: 'Laki-laki',
                    data: maleData,
                    backgroundColor: 'rgba(59, 130, 246, 0.5)', // blue-500
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1,
                    borderRadius: 4
                },
                {
                    label: 'Perempuan',
                    data: femaleData,
                    backgroundColor: 'rgba(236, 72, 153, 0.5)', // pink-500
                    borderColor: 'rgba(236, 72, 153, 1)',
                    borderWidth: 1,
                    borderRadius: 4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        boxWidth: 8
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(255, 255, 255, 0.9)',
                    titleColor: '#1f2937',
                    bodyColor: '#4b5563',
                    borderColor: '#e5e7eb',
                    borderWidth: 1,
                    padding: 10,
                    boxPadding: 4,
                    callbacks: {
                        label: function(context) {
                            return ' ' + context.dataset.label + ': ' + context.raw + " siswa";
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#f3f4f6',
                        drawBorder: false
                    },
                    title: {
                        display: true,
                        text: 'Jumlah Siswa'
                    }
                },
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    title: {
                        display: false
                    }
                }
            }
        }
    });
</script>
@endsection
