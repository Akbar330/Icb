@extends('layouts.main')

@section('title', 'Informasi')

@section('content')
    <div class="container py-4">
        <div class="row">
            <!-- Left Section: Daftar Informasi (70%) -->
            <div class="col-md-8 mb-4">
                <h1 class="display-4 text-primary text-center font-bold">Informasi Terbaru</h1>
                <p class="text-center text-muted mb-4">Berikut adalah beberapa informasi terbaru yang ada.</p>

                <ul class="list-group list-group-flush">
                    @foreach($informasi as $item)
                        <li class="list-group-item">
                            <h5 class="font-weight-bold text-primary">
                                <p class="text-decoration-none text-black">
                                    {{ $item->judul }}
                                </p>
                            </h5>
                            <p class="text-muted">{{ \Illuminate\Support\Str::limit($item->konten, 150) }}</p>
                            <a href="{{ route('informasi.show', $item->id) }}" class="btn btn-primary mt-2 mb-2">Lihat Selengkapnya</a><br>
                            <small class="text-secondary">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</small>

                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Right Section: Kontak Sekolah (30%) -->
            <div class="col-md-4">
                <!-- Card Gabungan -->
                <div class="card">
                    <div class="card-body">
                        <!-- Kontak Sekolah -->
                        <h5 class="card-title text-primary">Kontak Sekolah</h5>
                        <p class="card-text text-muted">
                            Alamat: Jalan Raya No. 123, Bandung, Jawa Barat
                        </p>
                        <p class="card-text text-muted">
                            Telepon: (022) 123-4567
                        </p>
                        <p class="card-text text-muted">
                            Email: info@sekolahku.sch.id
                        </p>
                        <p class="card-text text-muted">
                            Jam Operasional: Senin - Jumat, 08.00 - 15.00
                        </p>
                        <hr>

                        <!-- Form Pencarian Artikel -->
                        <h5 class="card-title text-primary">Cari Artikel</h5>
                        <form action="{{ route('artikel.search') }}" method="GET">
                            <div class="input-group mb-3">
                                <input type="text" name="query" class="form-control" placeholder="Cari artikel..." required>
                                <button class="btn btn-primary" type="submit">Cari</button>
                            </div>
                        </form>
                        <hr>

                        <!-- Daftar Artikel -->
                        <h5 class="card-title text-primary">Artikel Terkini</h5>
                        <ul class="list-group list-group-flush">
                            @foreach ($artikels as $artikel)
                                <li class="list-group-item">
                                    <a href="{{ route('artikel.show', $artikel->id) }}" class="text-decoration-none text-black">
                                        <strong>{{ $artikel->judul }}</strong>
                                    </a>
                                    <p class="text-muted mb-0" style="font-size: 0.85rem;">
                                        {{ Str::limit($artikel->konten, 100) }}
                                    </p>
                                    <small class="text-secondary">
                                        {{ \Carbon\Carbon::parse($artikel->created_at)->format('d M Y') }}
                                    </small>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
