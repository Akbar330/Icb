<!DOCTYPE html>
<html>
<head>
    <title>Data Pendaftar</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Data Pendaftar</h1>
    <table>
        <thead>
            <tr>
                <th>Judul</th>
                <th>Konten</th>
                <th>Penulis</th>
                <th>Gambar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($artikels as $artikel)
            <tr>
                <td>{{ $artikel->judul }}</td>
                <td>{{ $artikel->konten }}</td>
                <td>{{ $artikel->penulis }}</td>
                <td>{{ $artikel->gambar }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
