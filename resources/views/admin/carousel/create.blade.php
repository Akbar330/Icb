@extends('layouts.admin')

@section('title', 'Admin Carousel')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Carousel</title>
</head>
<body>
    <h1>Create New Carousel</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.carousel.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="order">Order:</label>
        <input type="number" id="order" name="order" value="{{ old('order') }}" required>
        <br><br>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required>
        <p class="text-xs text-blue-600 mt-2 font-medium"><i class="fas fa-info-circle mr-1"></i> Resolusi disarankan: 1920x1080 (16:9). Maks 2MB.</p>
        <br><br>

        <button type="submit" class="btn btn-primary">Create Carousel</button>
    </form>
</body>
</html>
@endsection
