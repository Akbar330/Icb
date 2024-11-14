<!-- resources/views/pendaftaran/success.blade.php -->
@extends('layouts.main')

@section('title', 'Pendaftaran Berhasil')

@section('content')
<div class="container mt-5">
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Pendaftaran Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: true,
                timer: 1500
            });
        </script>
    @endif
    <div class="text-center">
        <h3>Pendaftaran Anda Telah Berhasil!</h3>
        <p>Selamat, pendaftaran Anda telah diterima dan sedang diproses.</p>
        <a href="{{ route('pendaftaran.index') }}" class="btn btn-primary">Kembali ke Daftar Pendaftar</a>
    </div>
</div>
@endsection
