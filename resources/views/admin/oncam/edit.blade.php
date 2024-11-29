@extends('layouts.admin')

@section('title', 'Edit Oncam')

@section('content')
    <div class="px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-700">Edit Data Oncam</h1>

        <form action="{{ route('oncam.update', $oncams->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="embed_link" class="block text-gray-700 font-semibold">Embed Link</label>
                <input type="url" id="embed_link" name="embed_link" value="{{ old('embed_link', $oncams->embed_link) }}" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                @error('embed_link')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 hover:bg-blue-700">
                Update Data Oncam
            </button>
        </form>
    </div>
@endsection
