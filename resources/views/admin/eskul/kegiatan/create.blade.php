@extends('layouts.admin')

@section('title', 'Tulis Artikel / Berita Eskul')

@section('content')
<div class="px-4 py-6 max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-700">Tulis Artikel / Berita Eskul</h1>
            <p class="text-sm text-gray-500 mt-1">Buat artikel berita atau liputan kegiatan ekstrakurikuler menggunakan editor lengkap.</p>
        </div>
        <a href="{{ route('admin.kegiatan-eskul.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-xs font-semibold transition flex items-center gap-1.5">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
        <form action="{{ route('admin.kegiatan-eskul.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <!-- Pilih Eskul -->
            <div>
                <label for="eskul_id" class="block text-gray-700 font-semibold text-sm mb-1">Ekstrakurikuler <span class="text-red-500">*</span></label>
                @if(auth()->user()->role === 'eskul')
                    <input type="hidden" name="eskul_id" value="{{ auth()->user()->eskul_id }}">
                    <input type="text" disabled value="{{ auth()->user()->eskul ? auth()->user()->eskul->nama_eskul : '-' }}"
                           class="w-full p-2.5 bg-gray-100 border border-gray-300 rounded-lg text-sm text-gray-700 font-semibold cursor-not-allowed">
                @else
                    <select name="eskul_id" id="eskul_id" required
                            class="w-full p-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Pilih Ekstrakurikuler --</option>
                        @foreach($eskulList as $e)
                            <option value="{{ $e->id }}" {{ old('eskul_id', request('eskul_id')) == $e->id ? 'selected' : '' }}>{{ $e->nama_eskul }} ({{ $e->kategori }})</option>
                        @endforeach
                    </select>
                @endif
                @error('eskul_id')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Judul Artikel -->
            <div>
                <label for="judul" class="block text-gray-700 font-semibold text-sm mb-1">Judul Artikel / Berita <span class="text-red-500">*</span></label>
                <input type="text" id="judul" name="judul" value="{{ old('judul') }}" required
                       placeholder="Contoh: Tim Futsal SMK ICB Raih Juara 1 Turnamen Pelajar Kota Bandung"
                       class="w-full p-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('judul')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Penulis & Tanggal -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="penulis" class="block text-gray-700 font-semibold text-sm mb-1">Penulis / Kontributor</label>
                    <input type="text" id="penulis" name="penulis" value="{{ old('penulis', auth()->user()->name) }}"
                           placeholder="Contoh: Redaksi Eskul Futsal / Ahmad"
                           class="w-full p-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('penulis')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="tanggal_kegiatan" class="block text-gray-700 font-semibold text-sm mb-1">Tanggal Kegiatan</label>
                    <input type="date" id="tanggal_kegiatan" name="tanggal_kegiatan" value="{{ old('tanggal_kegiatan', date('Y-m-d')) }}"
                           class="w-full p-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('tanggal_kegiatan')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Deskripsi Singkat -->
            <div>
                <label for="deskripsi" class="block text-gray-700 font-semibold text-sm mb-1">Deskripsi Singkat (Ringkasan Cuplikan) <span class="text-red-500">*</span></label>
                <input type="text" id="deskripsi" name="deskripsi" value="{{ old('deskripsi') }}" required
                       placeholder="Ringkasan 1-2 kalimat untuk tampilan depan kartu artikel..."
                       class="w-full p-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('deskripsi')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Gambar Cover Artikel -->
            <div>
                <label for="foto" class="block text-gray-700 font-semibold text-sm mb-1">Gambar Cover Artikel <span class="text-red-500">*</span></label>
                <input type="file" id="foto" name="foto" required accept="image/*"
                       class="w-full p-2 border border-gray-300 rounded-lg text-sm bg-white" onchange="previewImage(this)">
                <p class="text-xs text-blue-600 mt-1 font-medium"><i class="fas fa-info-circle mr-1"></i> Resolusi disarankan: 1280x720 (16:9). Maks 5MB.</p>
                <div id="imagePreview" class="mt-3 hidden">
                    <img src="" id="previewImg" style="max-height: 220px; border-radius: 8px; border: 1px solid #e5e7eb; object-fit: cover;">
                </div>
                @error('foto')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Konten Artikel (TinyMCE) -->
            <div>
                <label for="editor" class="block text-gray-700 font-semibold text-sm mb-1">Konten Lengkap Artikel</label>
                <textarea id="editor" name="konten" rows="12"
                          class="w-full p-2 border border-gray-300 rounded-lg text-sm">{{ old('konten') }}</textarea>
                @error('konten')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tombol Simpan -->
            <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.kegiatan-eskul.index') }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-semibold transition">
                    Batal
                </a>
                <button type="submit" class="bg-blue-600 text-white font-semibold py-2.5 px-6 rounded-lg transition duration-300 hover:bg-blue-700 shadow-md shadow-blue-500/20 text-sm">
                    Publikasikan Artikel
                </button>
            </div>
        </form>
    </div>
</div>

<!-- TinyMCE Scripts -->
<script src="{{ asset('tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script>
    const base64_img_handler = (blobInfo) => new Promise((resolve) => {
        resolve("data:image/png;base64," + blobInfo.base64());
    });

    tinymce.init({
        selector: '#editor',
        plugins: 'lists link image',
        toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | outdent indent | link image',
        menubar: false,
        images_upload_handler: base64_img_handler,
    });

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
