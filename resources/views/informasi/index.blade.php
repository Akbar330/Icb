@extends('layouts.main')

@section('title', 'Informasi')

@section('content')
    <div class="container py-4">
        <div class="row">     
            <!-- Left Section: Daftar Informasi (70%) -->
            <div class="col-md-8 mb-4">
                <h1 class="display-4 text-primary text-center">Informasi Terbaru</h1>
                <p class="text-center text-muted mb-4">Berikut adalah beberapa informasi terbaru yang ada.</p>
                
                <ul class="list-group list-group-flush">
                    @foreach($informasi as $item)
                        <li class="list-group-item">
                            <h5 class="font-weight-bold text-primary">
                                <a href="{{ route('informasi.show', $item->id) }}" class="text-decoration-none text-primary">
                                    {{ $item->judul }}
                                </a>
                            </h5>
                            <p class="text-muted">{{ \Illuminate\Support\Str::limit($item->konten, 150) }}</p>
                            <small class="text-secondary">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</small>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Right Section: Kontak Sekolah (30%) -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
