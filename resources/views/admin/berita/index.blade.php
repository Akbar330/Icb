@extends('layouts.admin')

@section('title', 'Manajemen Berita')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Berita</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola dan publikasikan berita terbaru tentang kegiatan sekolah.</p>
    </div>
    <a href="{{ route('admin.berita.create') }}" class="inline-flex items-center bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-sm hover:bg-blue-700 hover:shadow-md transition-all">
        <i class="fas fa-plus mr-2"></i> Tambah Berita Baru
    </a>
</div>

<!-- Main Card -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <!-- Toolbar -->
    <div class="p-5 border-b border-gray-100 bg-gray-50/50 flex flex-col sm:flex-row justify-between items-center gap-4">
        <h2 class="font-semibold text-gray-700">Daftar Berita</h2>
        <div class="relative w-full sm:w-72">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400"></i>
            </div>
            <input type="text" id="search" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Cari berita berdasarkan judul...">
        </div>
    </div>

    <div class="p-5 bg-gray-50/30">
        <!-- Berita Cards Grid -->
        <div id="beritaCards" class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @forelse($beritas as $berita)
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md border border-gray-100 overflow-hidden flex flex-col transition-shadow duration-300 group">
                    <div class="relative h-48 overflow-hidden bg-gray-100 flex items-center justify-center p-2">
                        @if($berita->gambar)
                            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full h-full object-contain transition duration-500 group-hover:scale-110">
                        @else
                            <img src="{{ asset('foto_artikel.jpg') }}" alt="{{ $berita->judul }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                        @endif
                        <div class="absolute top-2 right-2 bg-white/90 backdrop-blur text-xs font-semibold px-2 py-1 rounded shadow-sm text-gray-700">
                            {{ $berita->created_at->format('d M Y') }}
                        </div>
                    </div>
                    
                    <div class="p-5 flex-1 flex flex-col">
                        <h3 class="text-lg font-bold text-gray-800 line-clamp-2 leading-tight mb-2 group-hover:text-blue-600 transition-colors" title="{{ $berita->judul }}">{{ $berita->judul }}</h3>
                        <div class="flex items-center text-xs text-gray-500 mb-4">
                            <i class="fas fa-user-edit mr-1.5 text-blue-500"></i> {{ $berita->penulis }}
                        </div>
                        
                        <div class="mt-auto pt-4 border-t border-gray-50 flex justify-between items-center gap-2">
                            <a href="{{ route('admin.berita.edit', $berita->id) }}" class="flex-1 text-center bg-blue-50 hover:bg-blue-100 text-blue-600 font-medium py-1.5 px-3 rounded-lg text-sm transition-colors">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                            <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
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
                        <i class="fas fa-bullhorn text-2xl text-gray-400"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">Belum ada berita</h3>
                    <p class="text-gray-500">Mulai buat berita pertama Anda untuk mengisi website.</p>
                </div>
            @endforelse
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
                        <p class="text-gray-500">Tidak ada berita yang cocok dengan kata kunci tersebut.</p>
                    </div>`;
                } else {
                    data.forEach(function(item) {
                        let imgSrc = item.gambar ? `${assetPath}/${item.gambar}` : defaultImg;
                        let imgClass = item.gambar ? 'object-contain p-2' : 'object-cover';
                        let dateObj = new Date(item.created_at);
                        let formattedDate = dateObj.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
                        
                        cards += `
                            <div class="bg-white rounded-xl shadow-sm hover:shadow-md border border-gray-100 overflow-hidden flex flex-col transition-shadow duration-300 group">
                                <div class="relative h-48 overflow-hidden bg-gray-100 flex items-center justify-center">
                                    <img src="${imgSrc}" alt="${item.judul}" class="w-full h-full ${imgClass} transition duration-500 group-hover:scale-110">
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
                                        <a href="/admin/berita/${item.id}/edit" class="flex-1 text-center bg-blue-50 hover:bg-blue-100 text-blue-600 font-medium py-1.5 px-3 rounded-lg text-sm transition-colors">
                                            <i class="fas fa-edit mr-1"></i> Edit
                                        </a>
                                        <form action="/admin/berita/${item.id}" method="POST" class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
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
                $('#beritaCards').html(cards);
            }
        });
    });
</script>
@endsection
