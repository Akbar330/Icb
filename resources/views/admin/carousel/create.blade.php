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

    <form action="{{ route('admin.carousel.store') }}" method="POST">
        @csrf
        <label for="order">Order:</label>
        <input type="number" id="order" name="order"
