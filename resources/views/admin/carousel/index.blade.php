<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carousel List</title>
</head>
<body>
    <h1>Carousel List</h1>
    <a href="{{ route('admin.carousel.create') }}">Add New Carousel</a>

    <ul>
        @foreach ($carousels as $carousel)
            <li>Order: {{ $carousel->order }}</li>
        @endforeach
    </ul>
</body>
</html>
