<table>
    <thead>
        <tr>
            <th>Nis</th>
            <th>Nama Siswa</th>
            <th>Alamat</th>
            <th>TTL</th> 
            <th>Agama</th> 
            <th>Jenis Kelamin</th>
            <th>Email</th>
            <th>Asal Sekolah</th>
            <th>Jalur Pendaftaran</th>
            <th>Jurusan</th>
            <th>No HP</th>
            <th>Anak Berkebutuhan Khusus</th>
            <th>Nama Orang Tua Wali</th>
            <th>Alamat Wali</th>
            <th>Pekerjaan Wali</th>
            <th>No HP Wali</th>
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
            <td>{{ $pendaftaran->agama }}</td>
            <td>{{ $pendaftaran->jenis_kelamin }}</td>
            <td>{{ $pendaftaran->email }}</td>
            <td>{{ $pendaftaran->asal_sekolah }}</td>
            <td>{{ $pendaftaran->jalur_pendaftaran }}</td>
            <td>{{ $pendaftaran->jurusan }}</td>
            <td>{{ $pendaftaran->no_hp }}</td>
            <td>{{ $pendaftaran->abk === 'Y' ? 'Ya' :'Tidak' }}</td>
            <td>{{ $pendaftaran->nama_ortu_wali }}</td>
            <td>{{ $pendaftaran->alamat_wali }}</td>
            <td>{{ $pendaftaran->pekerjaan_wali }}</td>
            <td>{{ $pendaftaran->no_hp_wali}}</td>
            <td>{{ $pendaftaran->mgm === 'Y' ? 'Ya' :'Tidak' }}</td>
            <td>{{ $pendaftaran->nama_mgm ?? '-' }}</td>
            <td>{{ $pendaftaran->asal_mgm ?? '-'}}</td>
            <td>{{  \Carbon\Carbon::parse($pendaftaran->created_at)->format('d-m-Y') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>