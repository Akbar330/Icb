@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
    <div>
        <h1 class="text-xl font-bold text-gray-800">Manajemen Pengguna</h1>
        <p class="text-xs text-gray-500 mt-1">Kelola akun Super Admin dan akun Pengurus Ekstrakurikuler.</p>
    </div>
    <a href="{{ route('admin.pengguna.create') }}" class="inline-flex items-center bg-blue-600 text-white text-xs font-semibold py-2.5 px-4 rounded-xl shadow-sm hover:bg-blue-700 transition-all">
        <i class="fas fa-user-plus mr-2"></i> Tambah Pengguna Baru
    </a>
</div>

<!-- Main Card -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <!-- Toolbar -->
    <div class="p-5 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
        <h2 class="font-semibold text-gray-700 text-xs">Daftar Akun Pengguna</h2>
        <span class="text-xs text-gray-400">Total: {{ $users->count() }} Pengguna</span>
    </div>

    <!-- Table Container -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-xs">
            <thead>
                <tr class="bg-gray-50/80 text-gray-500 uppercase tracking-wider font-semibold">
                    <th class="px-5 py-3.5 w-12 text-center">No</th>
                    <th class="px-5 py-3.5">Informasi Pengguna</th>
                    <th class="px-5 py-3.5">Role / Hak Akses</th>
                    <th class="px-5 py-3.5">Eskul yang Dikelola</th>
                    <th class="px-5 py-3.5">Tanggal Dibuat</th>
                    <th class="px-5 py-3.5 text-center w-28">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($users as $index => $user)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-5 py-3.5 text-center text-gray-400 font-medium">
                            {{ $index + 1 }}
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold mr-3 border border-blue-200 text-xs">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800">{{ $user->name }}</p>
                                    <p class="text-[11px] text-gray-400">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-3.5">
                            @if($user->role === 'eskul')
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 inline-flex items-center gap-1">
                                    <i class="fas fa-users-cog text-[10px]"></i> Pengurus Eskul
                                </span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-blue-50 text-blue-700 inline-flex items-center gap-1">
                                    <i class="fas fa-shield-alt text-[10px]"></i> Super Admin
                                </span>
                            @endif
                        </td>
                        <td class="px-5 py-3.5">
                            @if($user->role === 'eskul')
                                @if($user->eskul)
                                    <span class="font-semibold text-gray-800 flex items-center gap-1">
                                        <i class="fas fa-trophy text-amber-500 text-[11px]"></i>
                                        {{ $user->eskul->nama_eskul }}
                                    </span>
                                @else
                                    <span class="text-amber-500 italic text-[11px] flex items-center gap-1">
                                        <i class="fas fa-exclamation-circle"></i> Belum dihubungkan
                                    </span>
                                @endif
                            @else
                                <span class="text-gray-400">- Semua Akses -</span>
                            @endif
                        </td>
                        <td class="px-5 py-3.5 text-gray-600">
                            {{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('d M Y') : '-' }}
                        </td>
                        <td class="px-5 py-3.5 text-center">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('admin.pengguna.edit', $user->id) }}" class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 flex items-center justify-center transition" title="Edit">
                                    <i class="fas fa-pencil-alt text-xs"></i>
                                </a>
                                @if(auth()->id() !== $user->id)
                                    <button type="button" class="w-8 h-8 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 flex items-center justify-center transition" title="Hapus" onclick="confirmDelete({{ $user->id }})">
                                        <i class="fas fa-trash-alt text-xs"></i>
                                    </button>
                                    <form id="delete-form-{{ $user->id }}" action="{{ route('admin.pengguna.destroy', $user->id) }}" method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-400 italic">
                            Belum ada data pengguna.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(userId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Akun pengguna ini akan dihapus dari sistem!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + userId).submit();
            }
        });
    }
</script>
@endsection
