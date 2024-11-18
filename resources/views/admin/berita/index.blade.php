@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-700">Dashboard Admin</h1>
        <p class="text-lg text-gray-500 mt-2">Kelola Artikel dan Berita di Sekolah Anda</p>

        <!-- Dashboard Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <!-- Tambah Berita -->

            <!-- Tambah Berita -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                <h2 class="text-xl font-semibold text-gray-700">Tambah Berita</h2>
                <p class="text-gray-600 mt-2">Publikasikan berita terbaru terkait kegiatan dan informasi sekolah.</p>
                <a href="{{ route('admin.berita.create') }}" class="mt-4 inline-block bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 hover:bg-blue-700">
                    Tambah Berita
                </a>
            </div>
        </div>

        <!-- Daftar Berita dan Berita -->
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
        <div class="flex space-x-4">
            <a href="{{ route('admin.berita.exportExcel') }}"
               class="btn btn-success">
               Export Excel
            </a>
            <a href="{{ route('admin.berita.exportPdf') }}"
               class="btn btn-danger">
               Export PDF
            </a>
        </div>
    </div>
            <!-- Daftar Berita -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-700">Berita</h3>
                <table class="w-full mt-4 text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="border-b px-4 py-2">Gambar</th>
                            <th class="border-b px-4 py-2">Judul</th>
                            <th class="border-b px-4 py-2">Penulis</th>
                            <th class="border-b px-4 py-2">Tanggal</th>
                            <th class="border-b px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="beritaTable">
                        <!-- Loop berita dari database -->
                        @foreach($beritas as $berita)
                            <tr>
                                <td class="border-b px-4 py-2">
                                    @if($berita->gambar)
                                        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="w-20 h-20 object-cover rounded">
                                    @else
                                        <span class="text-gray-500">Tidak ada gambar</span>
                                    @endif
                                </td>
                                <td class="border-b px-4 py-2">{{ $berita->judul }}</td>
                                <td class="border-b px-4 py-2">{{ $berita->penulis }}</td>
                                <td class="border-b px-4 py-2">{{ $berita->created_at->format('d M Y') }}</td>
                                <td class="border-b px-4 py-2">
                                    <a href="{{ route('admin.berita.edit', $berita->id) }}" class="text-blue-500 hover:underline">Edit</a> |
                                    <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- jQuery CDN -->
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
                let rows = '';
                // Accessing the asset URL in Blade outside the JS template
                let assetPath = "{{ asset('storage/') }}"; // Store asset URL path

                // Loop through search results
                data.forEach(function(item) {
                    rows += `
                        <tr class="border-t">
                            <td class="px-4 py-2">
                                ${item.gambar ? `<img src="${assetPath}/${item.gambar}" alt="${item.judul}" class="w-20 h-20 object-cover rounded">` : '<span class="text-gray-500">Tidak ada gambar</span>'}
                            </td>
                            <td class="px-4 py-2">${item.judul}</td>
                            <td class="px-4 py-2">${item.penulis}</td>
                            <td class="px-4 py-2">${item.created_at}</td>
                            <td class="px-4 py-2">
                                <a href="/admin/berita/${item.id}" class="text-blue-600 hover:underline">Lihat</a>
                            </td>
                        </tr>`;
                });
                // Update the table body with the rows generated
                $('#beritaTable').html(rows);
            }
        });
    });
</script>

@endsection
