@extends('layouts.main')

@section('title', 'Pendaftaran')

@section('content')

<div class="container mt-5">
    <div class="text-2xl font-bold text-blue-700 leading-tight mb-4">
        <h3>PENERIMAAN SISWA BARU SMK ICB CINTA TEKNIKA KOTA BANDUNG TAHUN AKADEMIK 2024/2025</h3>
    </div>

    <h1 class="text-center mt-4 font-bold text-blue-700">Formulir Pendaftaran</h1>
    <!-- Alert jika pendaftaran berhasil -->
    @if(session('success'))
        <div class="alert alert-success mt-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf

        <!-- Data Siswa -->
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="nama_siswa">Nama Lengkap Siswa</label>
                <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" required></textarea>
            </div>
            <div class="form-group col-md-6">
                <label for="ttl">Tanggal Lahir</label>
                <input type="date" class="form-control" id="ttl" name="ttl" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="">Pilih</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="agama">Agama</label>
                <select class="form-control" id="agama" name="agama" required>
                    <option value="">Pilih</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen Protestan">Kristen Protestan</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Konghucu">Konghucu</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group col-md-6">
                <label for="asal_sekolah">Asal Sekolah</label>
                <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="jalur_pendaftaran">Jalur Pendaftaran</label>
                <select class="form-control" id="jalur_pendaftaran" name="jalur_pendaftaran" required>
                    <option value="">Pilih</option>
                    <option value="Reguler">Reguler</option>
                    <option value="RMP">RMP</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="jurusan">Jurusan</label>
                <select class="form-control" id="jurusan" name="jurusan" required>
                    <option value="">Pilih Jurusan</option>
                    <option value="TKR">TKR (Teknik Kendaraan Ringan)</option>
                    <option value="TSM">TSM (Teknik Sepeda Motor)</option>
                    <option value="RPL">RPL (Rekayasa Perangkat Lunak)</option>
                    <option value="TKJ">TKJ (Teknik Komputer dan Jaringan)</option>
                    <option value="FAR">FAR (Farmasi)</option>
                    <option value="KEP">KEP (Asisten Keperawatan)</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="no_hp">No HP</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" required>
            </div>
            <div class="form-group col-md-6">
                <label for="abk">Anak Berkebutuhan Khusus?</label>
                <select class="form-control" id="abk" name="abk" required>
                    <option value="">Pilih</option>
                    <option value="Y">Ya</option>
                    <option value="N">Tidak</option>
                </select>
            </div>
        </div>

        <!-- Informasi Orang Tua/Wali -->
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nama_ortu_wali">Nama Orang Tua/Wali</label>
                <input type="text" class="form-control" id="nama_ortu_wali" name="nama_ortu_wali" required>
            </div>
            <div class="form-group col-md-6">
                <label for="alamat_wali">Alamat Wali</label>
                <textarea class="form-control" id="alamat_wali" name="alamat_wali" required></textarea>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="pekerjaan_wali">Pekerjaan Wali</label>
                <input type="text" class="form-control" id="pekerjaan_wali" name="pekerjaan_wali" required>
            </div>
            <div class="form-group col-md-6">
                <label for="no_hp_wali">No HP Wali</label>
                <input type="text" class="form-control" id="no_hp_wali" name="no_hp_wali" required>
            </div>
        </div>

        <!-- MGM (Member Get Member) -->
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="mgm">MGM</label>
                <select class="form-control" id="mgm" name="mgm" required>
                    <option value="">Pilih</option>
                    <option value="Y">Ya</option>
                    <option value="N">Tidak</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="nama_mgm">Nama MGM</label>
                <input type="text" class="form-control" id="nama_mgm" name="nama_mgm">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="asal_mgm">Keterangan MGM</label>
                <input type="text" class="form-control" id="asal_mgm" name="asal_mgm">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Daftar</button>
    </form>
</div>

<script>
    (function() {
        'use strict'
        // Cegah pengiriman form jika ada input yang tidak valid
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>

@endsection