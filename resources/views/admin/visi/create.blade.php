@extends('layouts.admin')

@section('title', 'Tambah Visi')

@section('content')
    <div class="px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-700">Tambah Visi</h1>
        <p class="text-lg text-gray-500 mt-2">Tambahkan Visi atau pengumuman baru untuk pengunjung situs.</p>

        <form action="{{ route('admin.visi.store') }}" method="POST" enctype="multipart/form-data" class="mt-6">
            @csrf

            <!-- Visi -->
            <div class="mb-4">
                <label for="visi" class="block text-gray-700 font-semibold">Visi</label>
                <textarea name="visi" id="visi" rows="10" class="w-full p-2 border border-gray-300 rounded mt-1">{{ old('visi') }}</textarea>
                @error('visi')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Misi -->
            <div class="mb-4">
                <label for="misi" class="block text-gray-700 font-semibold">Misi</label>
                <textarea name="misi" id="misi" rows="10" class="w-full p-2 border border-gray-300 rounded mt-1">{{ old('misi') }}</textarea>
                @error('misi')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tujuan -->
            <div class="mb-4">
                <label for="tujuan" class="block text-gray-700 font-semibold">Tujuan</label>
                <textarea name="tujuan" id="tujuan" rows="10" class="w-full p-2 border border-gray-300 rounded mt-1">{{ old('tujuan') }}</textarea>
                @error('tujuan')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tombol Simpan -->
            <div class="mt-6">
                <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 transition duration-300">
                    Simpan Visi
                </button>
                <a href="{{ route('admin.visi.index') }}" class="ml-4 text-gray-600 hover:underline">Batal</a>
            </div>
        </form>
    </div>

    <!-- Script TinyMCE -->
    <script src="{{ asset('tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script>
        const base64_img_handler = (blobInfo) => new Promise((resolve) => {
            resolve("data:image/png;base64," + blobInfo.base64());
        });
        
        tinymce.init({
            selector: '#visi, #misi, #tujuan',  // Gunakan selector untuk masing-masing ID
            plugins: 'lists link image',
            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | outdent indent | link image',
            menubar: false,
            images_upload_handler: base64_img_handler,
        });
    </script>
@endsection
