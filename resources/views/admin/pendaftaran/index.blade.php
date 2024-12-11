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

    <!-- Card Section for Pendaftar -->
    <div id="pendaftarCards" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($pendaftarans as $pendaftaran)
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold text-blue-600">{{ $pendaftaran->nama_siswa }}</h3>
            <p class="text-gray-600">NIS: {{ $pendaftaran->nis }}</p>
            <p class="text-gray-600">Alamat: {{ $pendaftaran->alamat }}</p>
            <p class="text-gray-600">TTL: {{ \Carbon\Carbon::parse($pendaftaran->ttl)->format('d-m-Y') }}</p>
            <p class="text-gray-600">Jenis Kelamin: {{ $pendaftaran->jenis_kelamin }}</p>
            <p class="text-gray-600">Email: {{ $pendaftaran->email }}</p>
            <p class="text-gray-600">Jalur Pendaftaran: {{ $pendaftaran->jalur_pendaftaran }}</p>
            <p class="text-gray-600">Jurusan: {{ $pendaftaran->jurusan }}</p>
            <p class="text-gray-600">No HP: {{ $pendaftaran->no_hp }}</p>
            <div class="mt-4">
                <a href="{{ route('admin.pendaftaran.show', $pendaftaran->id) }}" class="text-blue-600 hover:underline">Lihat</a>
            </div>
        </div>
        @endforeach
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
                let cards = '';
                data.forEach(item => {
                    cards += `
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h3 class="text-xl font-semibold text-blue-600">${item.nama_siswa}</h3>
                        <p class="text-gray-600">NIS: ${item.nis}</p>
                        <p class="text-gray-600">Alamat: ${item.alamat}</p>
                        <p class="text-gray-600">TTL: ${item.ttl}</p>
                        <p class="text-gray-600">Jenis Kelamin: ${item.jenis_kelamin}</p>
                        <p class="text-gray-600">Email: ${item.email}</p>
                        <p class="text-gray-600">Jalur Pendaftaran: ${item.jalur_pendaftaran}</p>
                        <p class="text-gray-600">Jurusan: ${item.jurusan}</p>
                        <p class="text-gray-600">No HP: ${item.no_hp}</p>
                        <div class="mt-4">
                            <a href="/admin/pendaftaran/${item.id}" class="text-blue-600 hover:underline">Lihat</a>
                        </div>
                    </div>`;
                });
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
