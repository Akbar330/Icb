@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-700">Dashboard Admin</h1>
    <p class="text-lg text-gray-500 mt-2">Kelola Artikel dan Berita di Sekolah Anda</p>

    <!-- Dashboard Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <!-- Tambah Berita -->
        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
            <h2 class="text-xl font-semibold text-gray-700">Tambah Berita</h2>
            <p class="text-gray-600 mt-2">Publikasikan berita terbaru terkait kegiatan dan informasi sekolah.</p>
            <a href="{{ route('admin.berita.create') }}" class="mt-4 inline-block bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 hover:bg-blue-700">
                Tambah Berita
            </a>
        </div>
    </div>

    <!-- Daftar Berita -->
    <div class="mt-8">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Daftar Berita</h2>

        <!-- Search and Export Section -->
        <div class="mb-6 flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
            <!-- Input Live Search -->
            <input
                type="text"
                id="search"
                class="border px-4 py-2 rounded-lg w-full sm:w-1/3"
                placeholder="Cari data berita...">

            <!-- Tombol Export -->
            <div class="flex space-x-4 mt-4 sm:mt-0">
                <a href="{{ route('admin.berita.exportExcel') }}" class="bg-green-500 text-white py-2 px-4 rounded-lg shadow hover:bg-green-600">
                    Export Excel
                </a>
                <a href="{{ route('admin.berita.exportPdf') }}" class="bg-red-500 text-white py-2 px-4 rounded-lg shadow hover:bg-red-600">
                    Export PDF
                </a>
            </div>
        </div>

        <!-- Daftar Berita Responsif -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Loop berita dari database -->
            @foreach($beritas as $berita)
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="mb-4">
                        @if($berita->gambar)
                            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full h-40 object-cover rounded">
                        @else
                            <div class="w-full h-40 bg-gray-200 flex items-center justify-center rounded">
                                <span class="text-gray-500">Tidak ada gambar</span>
                            </div>
                        @endif
                    </div>
                    <h3 class="text-lg font-semibold text-gray-700">{{ $berita->judul }}</h3>
                    <p class="text-sm text-gray-500">Penulis: {{ $berita->penulis }}</p>
                    <p class="text-sm text-gray-500">Tanggal: {{ $berita->created_at->format('d M Y') }}</p>
                    <div class="mt-4 flex justify-between items-center">
                        <a href="{{ route('admin.berita.edit', $berita->id) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Live Search
    $('#search').on('keyup', function() {
        let query = $(this).val();
        $.ajax({
            url: "{{ route('admin.berita.search') }}",
            type: "GET",
            data: { query: query },
            success: function(data) {
                let container = '';
                let assetPath = "{{ asset('storage/') }}"; // Path to assets

                // Loop through search results and populate card content
                data.forEach(function(item) {
                    container += `
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <div class="mb-4">
                                ${item.gambar ? `<img src="${assetPath}/${item.gambar}" alt="${item.judul}" class="w-full h-40 object-cover rounded">` : '<div class="w-full h-40 bg-gray-200 flex items-center justify-center rounded"><span class="text-gray-500">Tidak ada gambar</span></div>'}
                            </div>
                            <h3 class="text-lg font-semibold text-gray-700">${item.judul}</h3>
                            <p class="text-sm text-gray-500">Penulis: ${item.penulis}</p>
                            <p class="text-sm text-gray-500">Tanggal: ${item.created_at}</p>
                            <div class="mt-4 flex justify-between items-center">
                                <a href="/admin/berita/${item.id}" class="text-blue-600 hover:underline">Lihat</a>
                            </div>
                        </div>`;
                });

                // Update the container with new cards
                $('.grid').html(container);
            }
        });
    });
</script>

@endsection
