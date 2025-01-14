@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-700">Dashboard Admin</h1>
        <p class="text-lg text-gray-500 mt-2">Kelola Polling Sekolah</p>

        <!-- Dashboard Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <!-- Tambah sapa -->
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                <h2 class="text-xl font-semibold text-gray-700">Tambah Polling</h2>
                <p class="text-gray-600 mt-2">Buat Polling kepada pengunjung.</p>
                <a href="{{ route('admin.polling.create') }}"
                    class="mt-4 inline-block bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 hover:bg-blue-700">
                    Tambah Polling
                </a>
            </div>

        </div>

        <!-- Daftar sapa dan Berita -->
        <div class="mt-8">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">List Polling</h2>

            <!-- Daftar sapa -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <table class="w-full mt-4 text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="border-b px-4 py-2">No</th>
                            <th class="border-b px-4 py-2">Nama Polling</th>
                            <th class="border-b px-4 py-2">tanggal dibuat</th>
                            <th class="border-b px-4 py-2">Tampil di Beranda</th>
                            <th class="border-b px-4 py-2">aksi</th>
                        </tr>
                    </thead>
                    <tbody id="sapaTable">
                        @foreach ($masterPollings as $polling)
                            <tr>
                                <td class="border-b px-4 py-2 text-center">{{ $loop->index + 1 }}</td>
                                <td class="border-b px-4 py-2 text-center">{{ $polling->nama_polling }}</td>
                                <td class="border-b px-4 py-2 text-center">
                                    {{ \Carbon\Carbon::parse($polling->created_at)->translatedFormat('d F Y') }}
                                </td>
                                <td class="border-b px-4 py-2 text-center">{{ $polling->isShowing == 1 ? 'Ya' : 'Tidak' }}
                                </td>
                                <td class="border-b px-4 py-2 flex gap-2 items-center justify-center">
                                    @if ($polling->isShowing == 0)
                                        <form action="{{ route('admin.polling.changeStatusShow', $polling->id) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <input id="isShowing" name="isShowing" type="hidden" value="1">
                                            <button type="submit"
                                                style="background-color: green; color: white; border: 1px 1px 1px 1px solid;border-radius:10px; padding: 5px 10px; cursor: pointer;">Tampilkan
                                                Di Beranda</button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.polling.changeStatusShow', $polling->id) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <input id="isShowing" name="isShowing" type="hidden" value="0">
                                            <button type="submit"
                                                style="background-color: rgb(43, 43, 43); color: white; border: 1px 1px 1px 1px solid;border-radius:10px; padding: 5px 10px; cursor: pointer;">Hapus
                                                Dari Beranda</button>
                                        </form>
                                    @endif
                                    |
                                    <a href="{{route('admin.polling.edit', $polling->id)}}" class="text-blue-500 hover:underline"
                                        style="background-color: blue; color: white; border: 1px 1px 1px 1px solid;border-radius:10px; padding: 5px 10px; cursor: pointer;">Edit</a>
                                    |
                                    <button style="background-color: red; color: white; border: 1px 1px 1px 1px solid;border-radius:10px; padding: 5px 10px; cursor: pointer;"
                                                    onclick="confirmDelete({{ $polling->id }})">Hapus</button>
                                                    <form id="delete-form-{{ $polling->id }}"
                                                        action="{{ route('admin.polling.destroy', $polling->id) }}" method="POST"
                                                        class="hidden">
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
@endsection
