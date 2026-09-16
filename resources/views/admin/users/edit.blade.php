@extends('layouts.admin')

@section('title', 'Edit Pengguna')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center justify-between bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <div>
            <h1 class="text-xl font-bold text-gray-800">Edit Pengguna: {{ $user->name }}</h1>
            <p class="text-xs text-gray-500 mt-1">Perbarui profil pengguna, role/hak akses, dan asosiasi ekstrakurikuler.</p>
        </div>
        <a href="{{ route('admin.pengguna.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-xs font-semibold transition flex items-center gap-1.5">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
        <form action="{{ route('admin.pengguna.update', $user->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Nama -->
            <div>
                <label for="name" class="block text-xs font-semibold text-gray-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                       class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl text-xs text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                @error('name')
                    <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-xs font-semibold text-gray-700 mb-1.5">Alamat Email <span class="text-red-500">*</span></label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                       class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl text-xs text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                @error('email')
                    <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Role Selection -->
            <div>
                <label for="role" class="block text-xs font-semibold text-gray-700 mb-1.5">Role / Hak Akses <span class="text-red-500">*</span></label>
                <select id="role" name="role" required onchange="toggleEskulSelect(this.value)"
                        class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl text-xs text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Super Admin (Akses Penuh Seluruh Sistem)</option>
                    <option value="eskul" {{ old('role', $user->role) === 'eskul' ? 'selected' : '' }}>Pengurus Eskul (Hanya Akses Profil & Kegiatan Eskul)</option>
                </select>
                @error('role')
                    <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pilih Eskul (Hanya tampil jika role = eskul) -->
            <div id="eskulSelectWrapper" class="{{ old('role', $user->role) === 'eskul' ? '' : 'hidden' }}">
                <label for="eskul_id" class="block text-xs font-semibold text-gray-700 mb-1.5">Hubungkan ke Ekstrakurikuler</label>
                <select id="eskul_id" name="eskul_id"
                        class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl text-xs text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    <option value="">-- Pilih Ekstrakurikuler --</option>
                    @foreach($eskuls as $e)
                        <option value="{{ $e->id }}" {{ old('eskul_id', $user->eskul_id) == $e->id ? 'selected' : '' }}>{{ $e->nama_eskul }} ({{ $e->kategori }})</option>
                    @endforeach
                </select>
                <p class="text-gray-400 text-[11px] mt-1">Akun ini hanya akan memiliki akses mengelola eskul yang dipilih di atas.</p>
                @error('eskul_id')
                    <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-xs font-semibold text-gray-700 mb-1.5">Password Baru (Kosongkan jika tidak ingin mengubah)</label>
                <input type="password" id="password" name="password"
                       placeholder="Minimal 8 karakter"
                       class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl text-xs text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                @error('password')
                    <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Confirmation -->
            <div>
                <label for="password_confirmation" class="block text-xs font-semibold text-gray-700 mb-1.5">Konfirmasi Password Baru</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                       placeholder="Ulangi password baru"
                       class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl text-xs text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.pengguna.index') }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-xs font-semibold transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-semibold shadow-md shadow-blue-500/20 transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleEskulSelect(role) {
        const wrapper = document.getElementById('eskulSelectWrapper');
        const select = document.getElementById('eskul_id');
        if (role === 'eskul') {
            wrapper.classList.remove('hidden');
        } else {
            wrapper.classList.add('hidden');
        }
    }
</script>
@endsection
