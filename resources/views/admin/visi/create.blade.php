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

