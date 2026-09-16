@extends('layouts.admin')

@section('title', 'Akun Belum Terhubung ke Eskul')

@section('content')
<div class="p-6">
    <div class="max-w-xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 p-8 text-center">
        <div class="w-16 h-16 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-exclamation-triangle text-2xl"></i>
        </div>
        <h2 class="text-xl font-bold text-gray-800 mb-2">Akun Belum Terhubung</h2>
        <p class="text-gray-600 text-sm leading-relaxed mb-6">
            Akun Anda berstatus sebagai pengurus Ekstrakurikuler, namun belum dihubungkan ke salah satu Ekstrakurikuler oleh Super Admin. Silakan hubungi Super Admin sekolah untuk menghubungkan akun Anda.
        </p>
        <div class="bg-gray-50 rounded-xl p-4 text-xs text-gray-500 text-left">
            <p><strong>Nama:</strong> {{ auth()->user()->name }}</p>
            <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
            <p><strong>Role:</strong> {{ ucfirst(auth()->user()->role) }}</p>
        </div>
    </div>
</div>
@endsection
