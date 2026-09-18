@extends('layouts.admin')

@section('title', 'Manajemen Polling')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Polling</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola polling atau jajak pendapat untuk pengunjung website.</p>
    </div>
    <a href="{{ route('admin.polling.create') }}" class="inline-flex items-center bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-sm hover:bg-blue-700 hover:shadow-md transition-all">
        <i class="fas fa-plus mr-2"></i> Buat Polling Baru
    </a>
</div>

<!-- Main Card -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <!-- Toolbar -->
    <div class="p-5 border-b border-gray-100 bg-gray-50/50">
        <h2 class="font-semibold text-gray-700">Daftar Polling</h2>
    </div>

    <!-- Table Container -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse whitespace-nowrap">
            <thead>
                <tr class="bg-gray-50/80 text-gray-500 text-xs uppercase tracking-wider">
                    <th class="px-6 py-4 font-medium border-b border-gray-100 w-16 text-center">No</th>
                    <th class="px-6 py-4 font-medium border-b border-gray-100">Nama Polling</th>
                    <th class="px-6 py-4 font-medium border-b border-gray-100 text-center">Tampil di Beranda</th>
                    <th class="px-6 py-4 font-medium border-b border-gray-100 text-center">Tanggal Dibuat</th>
                    <th class="px-6 py-4 font-medium border-b border-gray-100 text-center w-48">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                @forelse ($masterPollings as $index => $polling)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4 text-center text-gray-500 font-medium">
                            {{ $index + 1 }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-bold text-gray-800">{{ $polling->nama_polling }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if ($polling->isShowing == 1)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i> Ya
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    <i class="fas fa-times-circle mr-1"></i> Tidak
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center text-gray-600">
                            <i class="far fa-calendar-alt text-gray-400 mr-1"></i>
                            {{ \Carbon\Carbon::parse($polling->created_at)->translatedFormat('d M Y') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <!-- Tombol Toggle Tampil -->
                                @if ($polling->isShowing == 0)
                                    <form action="{{ route('admin.polling.changeStatusShow', $polling->id) }}" method="POST" class="inline" title="Tampilkan di Beranda">
                                        @csrf
                                        @method('PUT')
                                        <input name="isShowing" type="hidden" value="1">
                                        <button type="submit" class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.polling.changeStatusShow', $polling->id) }}" method="POST" class="inline" title="Sembunyikan dari Beranda">
                                        @csrf
                                        @method('PUT')
                                        <input name="isShowing" type="hidden" value="0">
                                        <button type="submit" class="p-2 text-gray-500 hover:bg-gray-100 rounded-lg transition-colors">
                                            <i class="fas fa-eye-slash"></i>
                                        </button>
                                    </form>
                                @endif
                                
                                <a href="{{ route('admin.polling.hasil', $polling->id) }}" class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors" title="Lihat Hasil Polling">
                                    <i class="fas fa-chart-pie"></i>
                                </a>
                                
                                <a href="{{ route('admin.polling.edit', $polling->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <button type="button" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus" onclick="confirmDelete({{ $polling->id }})">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <form id="delete-form-{{ $polling->id }}" action="{{ route('admin.polling.destroy', $polling->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-chart-bar text-4xl text-gray-300 mb-3"></i>
                                <p>Belum ada data polling yang dibuat.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(pollingId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data polling beserta pilihannya akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + pollingId).submit();
            }
        });
    }
</script>
@endsection
