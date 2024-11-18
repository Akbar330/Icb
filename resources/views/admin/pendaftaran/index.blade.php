@extends('layouts.admin')

@section('title', 'Data Pendaftar')

@section('content')
<div class="container mx-auto px-4 py-12">
    <h1 class="text-4xl font-bold text-blue-600 text-center">Data Pendaftar</h1>
    <p class="text-lg text-gray-600 text-center mb-6">Berikut adalah data pendaftar yang telah melakukan registrasi.</p>

    <!-- Chart Section -->
    <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
        <h2 class="text-2xl font-semibold text-blue-600 mb-4">Statistik Pendaftar Berdasarkan Jurusan dan Jenis Kelamin</h2>
        <canvas id="pendaftarChart" width="400" height="200"></canvas>
    </div>


    <!-- Table Section -->
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-blue-600 mb-4">Informasi Pendaftar</h2>

    <!-- Search and Export Section -->
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
        <!-- Input Live Search -->
        <input
            type="text"
            id="search"
            class="border px-4 py-2 rounded-lg w-full sm:w-1/3"
            placeholder="Cari data pendaftar...">

        <!-- Tombol Export -->
        <div class="flex space-x-4">
            <a href="{{ route('admin.pendaftaran.exportExcel') }}"
               class="btn btn-success">
               Export Excel
            </a>
            <a href="{{ route('admin.pendaftaran.exportPdf') }}"
               class="btn btn-danger">
               Export PDF
            </a>
        </div>
    </div>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left text-gray-700">Nama Siswa</th>
                        <th class="px-4 py-2 text-left text-gray-700">Alamat</th>
                        <th class="px-4 py-2 text-left text-gray-700">TTL</th>
                        <th class="px-4 py-2 text-left text-gray-700">Jenis Kelamin</th>
                        <th class="px-4 py-2 text-left text-gray-700">Email</th>
                        <th class="px-4 py-2 text-left text-gray-700">Jalur Pendaftaran</th>
                        <th class="px-4 py-2 text-left text-gray-700">Jurusan</th>
                        <th class="px-4 py-2 text-left text-gray-700">No HP</th>
                        <th class="px-4 py-2 text-left text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody id="pendaftarTable">
                    @foreach ($pendaftarans as $pendaftaran)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $pendaftaran->nama_siswa }}</td>
                        <td class="px-4 py-2">{{ $pendaftaran->alamat }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($pendaftaran->ttl)->format('d-m-Y') }}</td>
                        <td class="px-4 py-2">{{ $pendaftaran->jenis_kelamin }}</td>
                        <td class="px-4 py-2">{{ $pendaftaran->email }}</td>
                        <td class="px-4 py-2">{{ $pendaftaran->jalur_pendaftaran }}</td>
                        <td class="px-4 py-2">{{ $pendaftaran->jurusan }}</td>
                        <td class="px-4 py-2">{{ $pendaftaran->no_hp }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('admin.pendaftaran.show', $pendaftaran->id) }}" class="text-blue-600 hover:underline">Lihat</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
            data: { query },
            success: function(data) {
                let rows = '';
                data.forEach(item => {
                    rows += `
                        <tr class="border-t">
                            <td class="px-4 py-2">${item.nama_siswa}</td>
                            <td class="px-4 py-2">${item.alamat}</td>
                            <td class="px-4 py-2">${item.ttl}</td>
                            <td class="px-4 py-2">${item.jenis_kelamin}</td>
                            <td class="px-4 py-2">${item.email}</td>
                            <td class="px-4 py-2">${item.jalur_pendaftaran}</td>
                            <td class="px-4 py-2">${item.jurusan}</td>
                            <td class="px-4 py-2">${item.no_hp}</td>
                            <td class="px-4 py-2">
                                <a href="/admin/pendaftaran/${item.id}" class="text-blue-600 hover:underline">Lihat</a>
                            </td>
                        </tr>`;
                });
                $('#pendaftarTable').html(rows);
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
            datasets: [
                {
                    label: 'Laki-laki',
                    data: maleData,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Perempuan',
                    data: femaleData,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.raw + " siswa";
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Siswa'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Jurusan'
                    }
                }
            }
        }
    });
</script>
@endsection
