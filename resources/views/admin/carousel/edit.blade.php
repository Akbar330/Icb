@extends('layouts.admin')

@section('title', 'Edit Carousel')

@section('content')
<div class="px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-700">Edit Carousel</h1>

    <!-- Form Edit -->
    <form action="{{ route('admin.carousel.update', $carousel->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="order">Order:</label>
        <input type="number" id="order" name="order" value="{{ old('order', $carousel->order) }}" required class="border px-4 py-2 rounded-lg">
        <br><br>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*" class="border px-4 py-2 rounded-lg">
        <p class="text-xs text-blue-600 mt-2 font-medium"><i class="fas fa-info-circle mr-1"></i> Resolusi disarankan: 1920x1080 (16:9). Maks 2MB.</p>
        <br><br>

        <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg">Update Carousel</button>
    </form>
</div>
@endsection
