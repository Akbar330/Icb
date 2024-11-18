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
                <th>Nama Siswa</th>
                <th>Alamat</th>
                <th>TTL</th>
                <th>Jenis Kelamin</th>
                <th>Email</th>
                <th>Jalur Pendaftaran</th>
                <th>Jurusan</th>
                <th>No HP</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pendaftarans as $pendaftaran)
            <tr>
                <td>{{ $pendaftaran->nama_siswa }}</td>
                <td>{{ $pendaftaran->alamat }}</td>
                <td>{{ \Carbon\Carbon::parse($pendaftaran->ttl)->format('d-m-Y') }}</td>
                <td>{{ $pendaftaran->jenis_kelamin }}</td>
                <td>{{ $pendaftaran->email }}</td>
                <td>{{ $pendaftaran->jalur_pendaftaran }}</td>
                <td>{{ $pendaftaran->jurusan }}</td>
                <td>{{ $pendaftaran->no_hp }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
