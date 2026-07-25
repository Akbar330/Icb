@extends('layouts.admin')

@section('title', 'Manajemen Artikel')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Artikel</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola dan publikasikan artikel untuk pengunjung website.</p>
    </div>
    <a href="{{ route('admin.artikel.create') }}" class="inline-flex items-center bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-sm hover:bg-blue-700 hover:shadow-md transition-all">
        <i class="fas fa-plus mr-2"></i> Tambah Artikel Baru
    </a>
</div>

<!-- Main Card -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <!-- Toolbar -->
    <div class="p-5 border-b border-gray-100 bg-gray-50/50 flex flex-col sm:flex-row justify-between items-center gap-4">
        <h2 class="font-semibold text-gray-700">Daftar Artikel</h2>
        <div class="relative w-full sm:w-72">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400"></i>
            </div>
            <input type="text" id="search" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Cari artikel berdasarkan judul...">
        </div>
    </div>

    <div class="p-5 bg-gray-50/30">
        <!-- Artikel Cards Grid -->
        <div id="artikelCards" class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @forelse($artikels as $artikel)
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md border border-gray-100 overflow-hidden flex flex-col transition-shadow duration-300 group">
                    <div class="relative h-48 overflow-hidden bg-gray-100">
                        <img src="{{ $artikel->gambar !== null ? asset('storage/' . $artikel->gambar) : asset('foto_artikel.jpg') }}" alt="{{ $artikel->judul }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                        <div class="absolute top-2 right-2 bg-white/90 backdrop-blur text-xs font-semibold px-2 py-1 rounded shadow-sm text-gray-700">
                            {{ $artikel->created_at->format('d M Y') }}
                        </div>
                    </div>
                    
                    <div class="p-5 flex-1 flex flex-col">
                        <h3 class="text-lg font-bold text-gray-800 line-clamp-2 leading-tight mb-2 group-hover:text-blue-600 transition-colors" title="{{ $artikel->judul }}">{{ $artikel->judul }}</h3>
                        <div class="flex items-center text-xs text-gray-500 mb-4">
                            <i class="fas fa-user-edit mr-1.5 text-blue-500"></i> {{ $artikel->penulis }}
                        </div>
                        
                        <div class="mt-auto pt-4 border-t border-gray-50 flex justify-between items-center gap-2">
                            <a href="{{ route('admin.artikel.edit', $artikel->id) }}" class="flex-1 text-center bg-blue-50 hover:bg-blue-100 text-blue-600 font-medium py-1.5 px-3 rounded-lg text-sm transition-colors">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                            <form action="{{ route('admin.artikel.destroy', $artikel->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full text-center bg-red-50 hover:bg-red-100 text-red-600 font-medium py-1.5 px-3 rounded-lg text-sm transition-colors">
                                    <i class="fas fa-trash-alt mr-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white p-8 rounded-xl border border-dashed border-gray-300 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                        <i class="fas fa-newspaper text-2xl text-gray-400"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">Belum ada artikel</h3>
                    <p class="text-gray-500">Mulai buat artikel pertama Anda untuk mengisi website.</p>
                </div>
            @endforelse
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
                let defaultImg = "{{ asset('foto_artikel.jpg') }}";

                if (data.length === 0) {
                    cards = `
                    <div class="col-span-full bg-white p-8 rounded-xl border border-dashed border-gray-300 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                            <i class="fas fa-search text-2xl text-gray-400"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-1">Pencarian Tidak Ditemukan</h3>
                        <p class="text-gray-500">Tidak ada artikel yang cocok dengan kata kunci tersebut.</p>
                    </div>`;
                } else {
                    data.forEach(function(item) {
                        let imgSrc = item.gambar ? `${assetPath}/${item.gambar}` : defaultImg;
                        let dateObj = new Date(item.created_at);
                        let formattedDate = dateObj.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
                        
                        cards += `
                            <div class="bg-white rounded-xl shadow-sm hover:shadow-md border border-gray-100 overflow-hidden flex flex-col transition-shadow duration-300 group">
                                <div class="relative h-48 overflow-hidden bg-gray-100">
                                    <img src="${imgSrc}" alt="${item.judul}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                                    <div class="absolute top-2 right-2 bg-white/90 backdrop-blur text-xs font-semibold px-2 py-1 rounded shadow-sm text-gray-700">
                                        ${formattedDate}
                                    </div>
                                </div>
                                <div class="p-5 flex-1 flex flex-col">
                                    <h3 class="text-lg font-bold text-gray-800 line-clamp-2 leading-tight mb-2 group-hover:text-blue-600 transition-colors" title="${item.judul}">${item.judul}</h3>
                                    <div class="flex items-center text-xs text-gray-500 mb-4">
                                        <i class="fas fa-user-edit mr-1.5 text-blue-500"></i> ${item.penulis}
                                    </div>
                                    <div class="mt-auto pt-4 border-t border-gray-50 flex justify-between items-center gap-2">
                                        <a href="/admin/artikel/${item.id}/edit" class="flex-1 text-center bg-blue-50 hover:bg-blue-100 text-blue-600 font-medium py-1.5 px-3 rounded-lg text-sm transition-colors">
                                            <i class="fas fa-edit mr-1"></i> Edit
                                        </a>
                                        <form action="/admin/artikel/${item.id}" method="POST" class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full text-center bg-red-50 hover:bg-red-100 text-red-600 font-medium py-1.5 px-3 rounded-lg text-sm transition-colors">
                                                <i class="fas fa-trash-alt mr-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>`;
                    });
                }
                $('#artikelCards').html(cards);
            }
        });
    });
</script>
@endsection
