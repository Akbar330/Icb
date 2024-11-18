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
            @foreach ($beritas as $berita)
            <tr>
                <td>{{ $berita->judul }}</td>
                <td>{{ $berita->konten }}</td>
                <td>{{ $berita->penulis }}</td>
                <td>{{ $berita->gambar }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
