@extends('layouts.admin')

@section('title', 'Edit Visi')

@section('content')
    <div class="px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-700">Edit Visi</h1>
        <p class="text-lg text-gray-500 mt-2">Ubah visi atau pengumuman yang ada.</p>

        <!-- Form Edit Visi -->
        <form action="{{ route('admin.visi.update', $visi->id) }}" method="POST" enctype="multipart/form-data" class="mt-6">
            @csrf
            @method('PUT')

            <!-- Visi -->
            <div class="mb-4">
                <label for="visi" class="block text-gray-700 font-semibold">Visi</label>
                <textarea name="visi" id="visi" rows="10"
                          class="w-full p-2 border border-gray-300 rounded mt-1" required>{{ old('visi', $visi->visi) }}</textarea>
                @error('visi')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Misi -->
            <div class="mb-4">
                <label for="misi" class="block text-gray-700 font-semibold">Misi</label>
                <textarea name="misi" id="misi" rows="10"
                          class="w-full p-2 border border-gray-300 rounded mt-1" required>{{ old('misi', $visi->misi) }}</textarea>
                @error('misi')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tujuan -->
            <div class="mb-4">
                <label for="tujuan" class="block text-gray-700 font-semibold">Tujuan</label>
                <textarea name="tujuan" id="tujuan" rows="10"
                          class="w-full p-2 border border-gray-300 rounded mt-1" required>{{ old('tujuan', $visi->tujuan) }}</textarea>
                @error('tujuan')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tombol Simpan -->
            <div class="mt-6">
                <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 transition duration-300">
                    Update Visi
                </button>
                <a href="{{ route('admin.visi.index') }}" class="ml-4 text-gray-600 hover:underline">Batal</a>
            </div>
        </form>

        <!-- Form Hapus Visi -->
        <form action="{{ route('admin.visi.destroy', $visi->id) }}" method="POST" class="mt-6">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus visi ini?')"
                    class="bg-red-600 text-white font-semibold py-2 px-4 rounded hover:bg-red-700 transition duration-300">
                Hapus Visi
            </button>
        </form>
    </div>
    <!-- Place the first <script> tag in your HTML's <head> -->
        <script src="https://cdn.tiny.cloud/1/31txbs39d986m50dt9q9ahu1um6mv1eihnos6yy6v9gpzwpp/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

        <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
        <script>
          tinymce.init({
            selector: 'textarea',
            plugins: [
              // Core editing features
              'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
              // Your account includes a free trial of TinyMCE premium features
              // Try the most popular premium features until Jan 22, 2025:
              'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown','importword', 'exportword', 'exportpdf'
            ],
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [
              { value: 'First.Name', title: 'First Name' },
              { value: 'Email', title: 'Email' },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
          });
        </script>
@endsection


