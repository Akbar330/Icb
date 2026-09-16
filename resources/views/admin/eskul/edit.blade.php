@extends('layouts.admin')

@section('title', auth()->user()->role === 'eskul' ? 'Profil Eskul Saya' : 'Edit Ekstrakurikuler')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <div>
            <h1 class="text-xl font-bold text-gray-800">
                {{ auth()->user()->role === 'eskul' ? 'Kelola Profil Eskul ' . $eskul->nama_eskul : 'Edit Ekstrakurikuler: ' . $eskul->nama_eskul }}
            </h1>
            <p class="text-xs text-gray-500 mt-1">Perbarui informasi, jadwal latihan, pembina, dan foto cover ekstrakurikuler.</p>
        </div>
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.eskul.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-xs font-semibold transition flex items-center gap-1.5">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        @else
            <a href="{{ route('eskul.show', $eskul->slug) }}" target="_blank" class="px-4 py-2 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-xl text-xs font-semibold transition flex items-center gap-1.5">
                <i class="fas fa-external-link-alt"></i> Lihat di Web
            </a>
        @endif
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
        <form action="{{ route('admin.eskul.update', $eskul->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Eskul -->
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-2">Nama Ekstrakurikuler <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_eskul" value="{{ old('nama_eskul', $eskul->nama_eskul) }}" required
                           class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl text-xs text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    @error('nama_eskul')
                        <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                    <select name="kategori" required
                            class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl text-xs text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        @foreach($kategoriList as $kat)
                            <option value="{{ $kat }}" {{ old('kategori', $eskul->kategori) == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                        @endforeach
                    </select>
                    @error('kategori')
                        <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pembina -->
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-2">Nama Pembina / Pelatih</label>
                    <input type="text" name="pembina" value="{{ old('pembina', $eskul->pembina) }}"
                           placeholder="Contoh: Bpk. Ahmad Hidayat, S.Pd"
                           class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl text-xs text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                </div>

                <!-- Ketua Eskul -->
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-2">Ketua Eskul (Siswa)</label>
                    <input type="text" name="ketua" value="{{ old('ketua', $eskul->ketua) }}"
                           placeholder="Contoh: Rian Firmansyah"
                           class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl text-xs text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                </div>

                <!-- Jadwal -->
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-2">Jadwal Latihan / Kegiatan</label>
                    <input type="text" name="jadwal" value="{{ old('jadwal', $eskul->jadwal) }}"
                           placeholder="Contoh: Setiap Jumat, 15:00 - 17:00 WIB"
                           class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl text-xs text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                </div>

                <!-- Lokasi / Tempat -->
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-2">Lokasi / Ruangan</label>
                    <input type="text" name="tempat" value="{{ old('tempat', $eskul->tempat) }}"
                           placeholder="Contoh: Lapangan Utama / Lab Komputer"
                           class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl text-xs text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                </div>
            </div>

            <!-- Foto Banner / Logo Saat Ini & Ganti -->
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-2">Foto / Banner Ekstrakurikuler</label>
                @if($eskul->foto)
                    <div class="mb-3 flex items-center gap-4 p-3 bg-gray-50 rounded-xl border border-gray-200">
                        <img src="{{ asset('storage/' . $eskul->foto) }}" alt="Current Photo" class="h-20 w-32 object-cover rounded-lg border border-gray-200">
                        <div class="text-xs text-gray-500">
                            <span class="font-semibold text-gray-700 block">Foto Saat Ini</span>
                            <span class="text-[11px] text-gray-400">Pilih file baru di bawah jika ingin mengganti foto.</span>
                        </div>
                    </div>
                @endif

                <div class="border-2 border-dashed border-gray-200 rounded-2xl p-6 text-center hover:border-blue-400 transition bg-gray-50/50">
                    <input type="file" name="foto" id="foto" accept="image/*" class="hidden" onchange="previewImage(this)">
                    <label for="foto" class="cursor-pointer">
                        <div class="w-12 h-12 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center mx-auto mb-2 text-xl">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </div>
                        <span class="text-xs font-semibold text-blue-600 hover:text-blue-800 block">Upload Foto Baru (Opsional)</span>
                        <span class="text-[11px] text-gray-400 block mt-1">Maksimal 5MB (JPG, PNG, WEBP)</span>
                    </label>
                    <div id="imagePreview" class="mt-4 hidden">
                        <img src="" id="previewImg" class="max-h-48 rounded-xl mx-auto shadow-sm border border-gray-200 object-cover">
                    </div>
                </div>
            </div>

            <!-- Deskripsi Profil -->
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-2">Deskripsi / Profil Eskul</label>
                <textarea name="deskripsi" rows="4" placeholder="Jelaskan mengenai tujuan dan aktivitas ekstrakurikuler ini..."
                          class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl text-xs text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">{{ old('deskripsi', $eskul->deskripsi) }}</textarea>
            </div>

            <!-- Visi Misi -->
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-2">Visi & Misi Eskul (Opsional)</label>
                <textarea name="visi_misi" rows="3" placeholder="Tuliskan visi & misi ekstrakurikuler jika ada..."
                          class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl text-xs text-gray-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">{{ old('visi_misi', $eskul->visi_misi) }}</textarea>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.eskul.index') }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-xs font-semibold transition">
                        Batal
                    </a>
                @endif
                <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-semibold shadow-md shadow-blue-500/20 transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(input) {
        const preview = document.getElementById('imagePreview');
        const img = document.getElementById('previewImg');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
