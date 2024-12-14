@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-700">Dashboard Admin</h1>
        <p class="text-lg text-gray-500 mt-2">Kelola Pengguna/user</p>

        <!-- Dashboard Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <!-- Tambah sapa -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                <h2 class="text-xl font-semibold text-gray-700">Tambah Pengguna</h2>
                <p class="text-gray-600 mt-2">Tambah akun untuk sekolah atau organisasi</p>
                <a href="{{ route('admin.pengguna.create') }}" class="mt-4 inline-block bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 hover:bg-blue-700">
                    Tambah Pengguna
                </a>
            </div>

        </div>

        <!-- Daftar sapa dan Berita -->
        <div class="mt-8">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Daftar Pengguna</h2>

    <!-- Daftar sapa -->
    <div class="bg-white p-6 rounded-lg shadow-md"> 
        <table class="w-full mt-4 text-left border-collapse">
            <thead>
                <tr>
                    <th class="border-b px-4 py-2">Nama</th>
                    <th class="border-b px-4 py-2">Email</th>
                    <th class="border-b px-4 py-2">Tanggal Registrasi</th>
                    <th class="border-b px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody id="sapaTable">
                <!-- Loop berita dari database -->
                @foreach($users as $user)
                        <tr>
                            <td class="border-b px-4 py-2">{{ $user->name}}</td>
                            <td class="border-b px-4 py-2">{{ $user->email}}</td>
                            <td class="border-b px-4 py-2">{{ \Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}</td>
                            <td class="border-b px-4 py-2">
                                <a href="{{ route('admin.pengguna.edit', $user->id) }}" class="text-blue-500 hover:underline">Edit</a> |
                                <button class="text-red-500 hover:underline"  onclick="confirmDelete({{ $user->id }})">Hapus</button> 
                                <form id="delete-form-{{ $user->id }}" action="{{ route('admin.pengguna.destroy', $user->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(userId) {
        // Show SweetAlert2 confirmation prompt
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + userId).submit();
            }
        });
    }
</script>

</div>

@endsection
