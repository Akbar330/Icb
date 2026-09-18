@extends('layouts.admin')

@section('title', 'Hasil Polling - ' . $polling->nama_polling)

@section('content')
<div class="mb-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.polling.index') }}" class="p-2.5 bg-white border border-gray-200 hover:bg-gray-50 rounded-xl text-gray-600 transition-colors shadow-sm" title="Kembali ke Daftar Polling">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <div class="flex items-center gap-2">
                    <h1 class="text-2xl font-bold text-gray-800">{{ $polling->nama_polling }}</h1>
                    @if ($polling->isShowing == 1)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5 animate-pulse"></span> Aktif di Beranda
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-600">
                            Tidak Aktif
                        </span>
                    @endif
                </div>
                <p class="text-sm text-gray-500 mt-1">
                    Dibuat pada {{ \Carbon\Carbon::parse($polling->created_at)->translatedFormat('d F Y, H:i') }} WIB
                </p>
            </div>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('admin.polling.edit', $polling->id) }}" class="inline-flex items-center bg-white border border-gray-200 text-gray-700 font-semibold py-2 px-4 rounded-lg shadow-sm hover:bg-gray-50 transition-all text-sm">
                <i class="fas fa-edit mr-2 text-blue-600"></i> Edit Polling
            </a>
        </div>
    </div>
</div>

<!-- Stat Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
    <!-- Total Suara -->
    <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Total Suara Masuk</p>
            <h3 class="text-3xl font-extrabold text-gray-800">{{ number_format($totalVotes, 0, ',', '.') }}</h3>
            <p class="text-xs text-gray-500 mt-1">Suara dari seluruh pengunjung</p>
        </div>
        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl">
            <i class="fas fa-vote-yea"></i>
        </div>
    </div>

    <!-- Pilihan Terbanyak -->
    @php
        $topOption = $pilihanVotes->sortByDesc('total_vote')->first();
    @endphp
    <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Pilihan Terbanyak</p>
            <h3 class="text-lg font-bold text-gray-800 line-clamp-1" title="{{ $topOption && $totalVotes > 0 ? $topOption->option : '-' }}">
                {{ $topOption && $totalVotes > 0 ? $topOption->option : 'Belum Ada Suara' }}
            </h3>
            <p class="text-xs text-green-600 font-medium mt-1">
                @if ($topOption && $totalVotes > 0)
                    <i class="fas fa-arrow-up mr-1"></i> {{ $topOption->total_vote }} suara ({{ $topOption->persentase }}%)
                @else
                    -
                @endif
            </p>
        </div>
        <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center text-xl">
            <i class="fas fa-trophy"></i>
        </div>
    </div>

    <!-- Total Opsi -->
    <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Jumlah Pilihan</p>
            <h3 class="text-3xl font-extrabold text-gray-800">{{ $pilihanVotes->count() }} Opsi</h3>
            <p class="text-xs text-gray-500 mt-1">Tersedia untuk dipilih</p>
        </div>
        <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl">
            <i class="fas fa-list-ol"></i>
        </div>
    </div>
</div>

<!-- Breakdown Hasil Suara -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
    <div class="p-5 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
        <h2 class="font-bold text-gray-800 text-base flex items-center">
            <i class="fas fa-chart-bar mr-2 text-blue-600"></i> Rincian Perolehan Suara
        </h2>
        <span class="text-xs text-gray-500">Persentase dihitung dari total suara</span>
    </div>

    <div class="p-6 space-y-6">
        @php
            $colors = [
                ['bar' => 'bg-blue-600', 'text' => 'text-blue-600', 'bg' => 'bg-blue-50'],
                ['bar' => 'bg-indigo-600', 'text' => 'text-indigo-600', 'bg' => 'bg-indigo-50'],
                ['bar' => 'bg-emerald-600', 'text' => 'text-emerald-600', 'bg' => 'bg-emerald-50'],
                ['bar' => 'bg-amber-500', 'text' => 'text-amber-600', 'bg' => 'bg-amber-50'],
                ['bar' => 'bg-rose-500', 'text' => 'text-rose-600', 'bg' => 'bg-rose-50'],
            ];
        @endphp

        @foreach ($pilihanVotes as $index => $item)
            @php
                $color = $colors[$index % count($colors)];
            @endphp
            <div class="p-4 rounded-xl border border-gray-100 bg-gray-50/30 hover:bg-white hover:shadow-sm transition-all">
                <div class="flex justify-between items-center mb-2">
                    <div class="flex items-center gap-2">
                        <span class="w-6 h-6 rounded-lg {{ $color['bg'] }} {{ $color['text'] }} text-xs font-bold flex items-center justify-center">
                            {{ $index + 1 }}
                        </span>
                        <span class="font-semibold text-gray-800 text-sm md:text-base">{{ $item->option }}</span>
                    </div>
                    <div class="text-right">
                        <span class="text-base font-bold text-gray-800">{{ $item->persentase }}%</span>
                        <span class="text-xs text-gray-500 ml-1">({{ $item->total_vote }} suara)</span>
                    </div>
                </div>
                
                <!-- Progress Bar -->
                <div class="w-full bg-gray-200 rounded-full h-3.5 overflow-hidden shadow-inner">
                    <div class="{{ $color['bar'] }} h-3.5 rounded-full transition-all duration-700 ease-out" style="width: {{ $item->persentase }}%"></div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Tabel Riwayat Suara Masuk -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-5 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
        <div>
            <h2 class="font-bold text-gray-800 text-base flex items-center">
                <i class="fas fa-history mr-2 text-gray-600"></i> Log Riwayat Suara Masuk
            </h2>
            <p class="text-xs text-gray-500 mt-0.5">Daftar vote terbaru yang dilakukan oleh pengunjung</p>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse whitespace-nowrap">
            <thead>
                <tr class="bg-gray-50/80 text-gray-500 text-xs uppercase tracking-wider">
                    <th class="px-6 py-3.5 font-medium border-b border-gray-100 text-center w-16">No</th>
                    <th class="px-6 py-3.5 font-medium border-b border-gray-100">Pilihan Suara</th>
                    <th class="px-6 py-3.5 font-medium border-b border-gray-100">Alamat IP</th>
                    <th class="px-6 py-3.5 font-medium border-b border-gray-100 text-center">Tanggal & Waktu</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                @forelse ($riwayatVotes as $idx => $vote)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-3.5 text-center text-gray-500 font-medium">
                            {{ $riwayatVotes->firstItem() + $idx }}
                        </td>
                        <td class="px-6 py-3.5">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">
                                <i class="fas fa-check mr-1.5 text-blue-500"></i> {{ $vote->pilihan_nama }}
                            </span>
                        </td>
                        <td class="px-6 py-3.5 text-gray-600 font-mono text-xs">
                            {{ $vote->ip }}
                        </td>
                        <td class="px-6 py-3.5 text-center text-gray-500 text-xs">
                            {{ \Carbon\Carbon::parse($vote->created_at)->translatedFormat('d M Y, H:i:s') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <i class="far fa-clipboard text-3xl text-gray-300 mb-2"></i>
                                <p class="text-sm">Belum ada data suara masuk untuk polling ini.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($riwayatVotes->hasPages())
        <div class="p-4 border-t border-gray-100 bg-gray-50/30 flex justify-center">
            {{ $riwayatVotes->links('pagination::bootstrap-4') }}
        </div>
    @endif
</div>
@endsection
