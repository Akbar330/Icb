@extends('layouts.main')

@section('title', 'Hasil Pencarian')

@section('content')
    <div class="container py-4">
        <div class="row">
            <!-- Left Section: Hasil Pencarian (70%) -->
            <div class="col-md-8 mb-4">
                <h1 class="display-4 text-primary text-center font-bold">Hasil Pencarian</h1>
                <p class="text-center text-muted mb-4">
                    Menampilkan hasil untuk: <strong>"{{ $query }}"</strong>
                </p>

                <div class="d-flex flex-column gap-4">
                    @if ($artikels->isEmpty())
                        <p class="text-muted">Tidak ada artikel yang cocok dengan pencarian "{{ $query }}".</p>
                    @else
                        @foreach ($artikels as $artikel)
                            <div class="d-flex py-3 border-bottom">
                                @if ($artikel->gambar)
                                    <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="Gambar Artikel" class="img-fluid rounded me-3" style="width: 150px; height: 150px; object-fit: cover;">
                                @endif
                                <div>
                                    <h3 class="text-primary">
                                        <a href="{{ route('artikel.show', $artikel->id) }}" class="text-decoration-none text-black">
                                            {{ $artikel->judul }}
                                        </a>
                                    </h3>
                                    <p class="text-muted mb-2">{{ \Illuminate\Support\Str::limit($artikel->konten, 150) }}</p>
                                    <small class="text-secondary">Penulis: {{ $artikel->penulis }}</small> |
                                    <small class="text-secondary">{{ \Carbon\Carbon::parse($artikel->created_at)->format('d M Y') }}</small>
                                    <br><a href="{{ route('artikel.show', $artikel->id) }}" class="btn btn-primary mt-2">
                                        Lihat Selengkapnya
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Right Section: Kontak Sekolah (30%) -->
            <div class="col-md-4">
                <div class="card mb-4">
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

                <!-- Form Pencarian -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Cari Artikel Lagi</h5>
                        <form action="{{ route('artikel.search') }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="query" class="form-control" placeholder="Cari artikel..." required>
                                <button class="btn btn-primary" type="submit">Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
