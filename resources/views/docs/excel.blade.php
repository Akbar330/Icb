<table>
    <thead>
        <tr>
            <th>Nis</th>
            <th>Nama Siswa</th>
            <th>Alamat</th>
            <th>TTL</th>
            <th>Jenis Kelamin</th>
            <th>Email</th>
            <th>Jalur Pendaftaran</th>
            <th>Jurusan</th>
            <th>No HP</th>
            <th>MGM</th>
            <th>Nama MGM</th>
            <th>Asal MGM</th>
            <th>Tanggal Daftar</th>
        </tr>
    </thead>
    <tbody >
        @foreach ($pendaftarans as $pendaftaran)
        <tr>
            <td>{{ $pendaftaran->nis }}</td>
            <td>{{ $pendaftaran->nama_siswa }}</td>
            <td>{{ $pendaftaran->alamat }}</td>
            <td>{{ \Carbon\Carbon::parse($pendaftaran->ttl)->format('d-m-Y') }}</td>
            <td>{{ $pendaftaran->jenis_kelamin }}</td>
            <td>{{ $pendaftaran->email }}</td>
            <td>{{ $pendaftaran->jalur_pendaftaran }}</td>
            <td>{{ $pendaftaran->jurusan }}</td>
            <td>{{ $pendaftaran->no_hp }}</td>
            <td>{{ $pendaftaran->mgm }}</td>
            <td>{{ $pendaftaran->nama_mgm ?? 'Tidak Ada' }}</td>
            <td>{{ $pendaftaran->asal_mgm ?? 'Tidak Ada'}}</td>
            <td>{{  \Carbon\Carbon::parse($pendaftaran->created_at)->format('d-m-Y') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>