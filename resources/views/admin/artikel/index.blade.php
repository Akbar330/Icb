@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-700 text-center">Dashboard Admin</h1>
    <p class="text-lg text-gray-500 text-center mt-2">Kelola Artikel dan Berita di Sekolah Anda</p>

    <!-- Dashboard Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <!-- Tambah Artikel -->
        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
            <h2 class="text-xl font-semibold text-gray-700">Tambah Artikel</h2>
            <p class="text-gray-600 mt-2">Buat artikel baru untuk berbagi informasi penting dengan pengunjung.</p>
            <a href="{{ route('admin.artikel.create') }}" class="mt-4 inline-block bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 hover:bg-blue-700">
                Tambah Artikel
            </a>
        </div>
    </div>

    <!-- Daftar Artikel -->
    <div class="mt-8">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Daftar Artikel</h2>

        <!-- Search and Export Section -->
        <div class="mb-6 flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
            <!-- Input Live Search -->
            <input
                type="text"
                id="search"
                class="border px-4 py-2 rounded-lg w-full sm:w-1/3"
                placeholder="Cari data artikel...">

            <!-- Tombol Export -->
            <div class="flex space-x-4">
                <a href="{{ route('admin.artikel.exportExcel') }}"
                   class="btn btn-success">
                   Export Excel
                </a>
                <a href="{{ route('admin.artikel.exportPdf') }}"
                   class="btn btn-danger">
                   Export PDF
                </a>
            </div>
        </div>

        <!-- Artikel Cards -->
        <div id="artikelCards" class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($artikels as $artikel)
                <div class="bg-white rounded-lg shadow-md p-4">
                    {{-- @if($artikel->gambar) --}}
                        <img src="{{ $artikel->gambar !== null ? asset('storage/' . $artikel->gambar) : asset('foto_artikel.jpg') }}" alt="{{ $artikel->judul }}" class="w-full h-48 object-cover rounded-t-md">
                    {{-- @else --}}
                        {{-- <div class="w-full h-48 bg-gray-200 flex items-center justify-center rounded-t-md">
                            <span class="text-gray-500">Tidak ada gambar</span>
                        </div> --}}
                    {{-- @endif --}}
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-700">{{ $artikel->judul }}</h3>
                        <p class="text-sm text-gray-500">Penulis: {{ $artikel->penulis }}</p>
                        <p class="text-sm text-gray-500">Tanggal: {{ $artikel->created_at->format('d M Y') }}</p>

                        <div class="mt-4 flex justify-between items-center">
                            <a href="{{ route('admin.artikel.edit', $artikel->id) }}" class="text-blue-500 hover:underline">Edit</a>
                            <form action="{{ route('admin.artikel.destroy', $artikel->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
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
            url: "{{ route('admin.artikel.search') }}",
            type: "GET",
            data: { query: query },
            success: function(data) {
                let cards = '';
                let assetPath = "{{ asset('storage/') }}";

                data.forEach(function(item) {
                    cards += `
                        <div class="bg-white rounded-lg shadow-md p-4">
                            ${item.gambar ? `<img src="${assetPath}/${item.gambar}" alt="${item.judul}" class="w-full h-48 object-cover rounded-t-md">` : `<div class="w-full h-48 bg-gray-200 flex items-center justify-center rounded-t-md"><span class="text-gray-500">Tidak ada gambar</span></div>`}
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-700">${item.judul}</h3>
                                <p class="text-sm text-gray-500">Penulis: ${item.penulis}</p>
                                <p class="text-sm text-gray-500">Tanggal: ${item.created_at}</p>
                                <div class="mt-4 flex justify-between items-center">
                                    <a href="/admin/artikel/${item.id}/edit" class="text-blue-500 hover:underline">Edit</a>
                                    <a href="/admin/artikel/${item.id}" class="text-blue-600 hover:underline">Hapus</a>
                                </div>
                            </div>
                        </div>`;
                });
                $('#artikelCards').html(cards);
            }
        });
    });
</script>
@endsection
