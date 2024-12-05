@extends('layouts.admin')

@section('title', 'Tambah Berita')

@section('content')
    <div class="px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-700">Tambah Berita</h1>
        <p class="text-lg text-gray-500 mt-2">Buat berita baru untuk berbagi informasi penting dengan pengunjung.</p>

        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="mt-6">
            @csrf

            <!-- Judul Berita -->
            <div class="mb-4">
                <label for="judul" class="block text-gray-700 font-semibold">Judul Berita</label>
                <input type="text" id="judul" name="judul" value="{{ old('judul') }}"
                       class="w-full p-2 border border-gray-300 rounded mt-1" required>
                @error('judul')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Penulis Berita -->
            <div class="mb-4">
                <label for="penulis" class="block text-gray-700 font-semibold">Penulis</label>
                <input type="text" id="penulis" name="penulis" value="{{ old('penulis') }}"
                       class="w-full p-2 border border-gray-300 rounded mt-1" required>
                @error('penulis')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700 font-semibold">Deskripsi Singkat</label>
                <input type="text" id="deskripsi" name="deskripsi" value="{{ old('deskripsi') }}"
                       class="w-full p-2 border border-gray-300 rounded mt-1" required>
                @error('deskripsi')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <!-- Konten Berita -->
            <div class="mb-4"> 
                <label for="konten" class="block text-gray-700 font-semibold">Konten</label>
                <textarea id="editor" name="konten" rows="6"
                          class="w-full p-2 border border-gray-300 rounded mt-1" >{{ old('konten') }}</textarea>
                @error('konten')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Gambar Berita -->
            {{-- <div class="mb-4">
                <label for="gambar" class="block text-gray-700 font-semibold">Gambar</label>
                <input type="file" id="gambar" name="gambar"
                       class="w-full p-2 border border-gray-300 rounded mt-1" accept="image/*">
                @error('gambar')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div> --}}

            <!-- Tombol Simpan -->
            <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 hover:bg-blue-700">
                Simpan Berita
            </button>
        </form>
    </div>
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


    </script>
@endsection
