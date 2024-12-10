@extends('layouts.admin')

@section('title', 'Edit Berita')

@section('content')
    <div class="px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-700">Edit Berita</h1>
        <p class="text-lg text-gray-500 mt-2">Ubah berita yang sudah ada</p>

        <!-- Form Edit Berita -->
        <div class="bg-white p-6 rounded-lg shadow-md mt-6">
            <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Judul Berita -->
                <div class="mb-4">
                    <label for="judul" class="block text-gray-700 font-semibold">Judul Berita</label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul', $berita->judul) }}"
                           class="w-full mt-2 p-2 border border-gray-300 rounded-md" required>
                    @error('judul')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Penulis Berita -->
                <div class="mb-4">
                    <label for="penulis" class="block text-gray-700 font-semibold">Penulis</label>
                    <input type="text" id="penulis" name="penulis" value="{{ old('penulis', $berita->penulis) }}"
                           class="w-full mt-2 p-2 border border-gray-300 rounded-md" required>
                    @error('penulis')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="penulis" class="block text-gray-700 font-semibold">Deskripsi Singkat</label>
                    <input type="text" id="penulis" name="penulis" value="{{ old('penulis', $berita->penulis) }}"
                           class="w-full mt-2 p-2 border border-gray-300 rounded-md" required>
                    @error('penulis')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="gambar" class="block text-gray-700 font-semibold">Gambar Cover</label>
                    <input type="file" id="gambar" name="gambar" class="w-full p-2 border border-gray-300 rounded mt-1"
                        accept="image/*">
                    @error('gambar')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Konten Berita -->
                <div class="mb-4">
                    <label for="konten" class="block text-gray-700 font-semibold">Konten Berita</label>
                    <textarea id="editor" name="konten" rows="6"
                              class="w-full mt-2 p-2 border border-gray-300 rounded-md" >{{ old('konten', $berita->konten) }}</textarea>
                    @error('konten')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tombol Simpan -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white py-2 px-6 rounded-md hover:bg-blue-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
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
