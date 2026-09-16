<?php

namespace Database\Seeders;

use App\Models\Eskul;
use App\Models\KegiatanEskul;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EskulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Eskul::count() > 0) {
            return;
        }

        $galeris = DB::table('galeris')->pluck('filename')->toArray();
        $adminUser = User::where('role', 'admin')->first();

        $eskuls = [
            [
                'nama_eskul' => 'Paskibra (Pasukan Pengibar Bendera)',
                'slug'       => 'paskibra',
                'kategori'   => 'Kepemimpinan & Bela Negara',
                'pembina'    => 'Drs. Supriatna, M.Pd',
                'ketua'      => 'Muhammad Farel (XI TKR)',
                'jadwal'     => 'Rabu & Jumat, 15:30 - 17:00 WIB',
                'tempat'     => 'Lapangan Utama SMK ICB Cinta Teknika',
                'foto'       => $galeris[0] ?? null,
                'deskripsi'  => "Ekstrakurikuler Paskibra melatih kedisiplinan, kepemimpinan, kekompakan, dan rasa cinta tanah air. Anggota Paskibra SMK ICB aktif bertugas dalam upacara resmi dan kompetisi baris-berbaris tingkat kota dan provinsi.",
                'visi_misi'  => "Visi: Membentuk generasi muda yang disiplin, berakhlak mulia, berwawasan kebangsaan, dan berprestasi.\nMisi:\n1. Mengembangkan keterampilan baris-berbaris yang presisi.\n2. Menumbuhkan rasa tanggung jawab dan jiwa korsa positif.",
                'kegiatans'  => [
                    [
                        'judul'            => 'Latihan Gabungan dan Simulasi Upacara Hari Kemerdekaan',
                        'tanggal_kegiatan' => '2025-08-15',
                        'foto'             => $galeris[0] ?? null,
                        'deskripsi'        => "Kegiatan pemantapan formasi pengibaran bendera merah putih menjelang upacara peringatan kemerdekaan. Seluruh anggota menunjukkan dedikasi dan semangat tinggi.",
                    ]
                ]
            ],
            [
                'nama_eskul' => 'Futsal Club',
                'slug'       => 'futsal',
                'kategori'   => 'Olahraga',
                'pembina'    => 'Bpk. Rizky Ramadhan, S.Pd',
                'ketua'      => 'Aldi Pratama (XI RPL)',
                'jadwal'     => 'Selasa & Kamis, 16:00 - 18:00 WIB',
                'tempat'     => 'Lapangan Futsal Sekolah',
                'foto'       => $galeris[1] ?? null,
                'deskripsi'  => "Eskul Futsal menjadi wadah menyalurkan bakat olahraga sepak bola mini, membangun kebugaran fisik, strategi tim, dan mental sportif. Rutin berpartisipasi dalam turnamen antar sekolah se-Bandung Raya.",
                'visi_misi'  => "Visi: Menjadi tim futsal sekolah yang solid, sportif, dan berprestasi di tingkat daerah maupun nasional.",
                'kegiatans'  => [
                    [
                        'judul'            => 'Uji Tanding Persahabatan dan Latihan Strategi Taktikal',
                        'tanggal_kegiatan' => '2025-09-02',
                        'foto'             => $galeris[1] ?? null,
                        'deskripsi'        => "Pertandingan uji coba antar kelas dan persiapan menjelang turnamen futsal piala walikota tahun ini.",
                    ]
                ]
            ],
            [
                'nama_eskul' => 'Pramuka (Gerakan Pramuka)',
                'slug'       => 'pramuka',
                'kategori'   => 'Kepemimpinan & Bela Negara',
                'pembina'    => 'Ibu Nina Marlina, S.T',
                'ketua'      => 'Bagus Prasetyo (XI TKJ)',
                'jadwal'     => 'Jumat, 13:30 - 15:30 WIB',
                'tempat'     => 'Aula & Lapangan Terbuka',
                'foto'       => $galeris[2] ?? null,
                'deskripsi'  => "Gerakan Pramuka gugus depan SMK ICB Cinta Teknika mendidik kemandirian, keterampilan alam terbuka (survival), gotong royong, dan kepedulian sosial kemasyarakatan.",
                'visi_misi'  => "Visi: Membentuk pribadi yang berkarakter, peduli sesama, dan berjiwa sosial tinggi.",
                'kegiatans'  => [
                    [
                        'judul'            => 'Kemah Bakti dan Pelantikan Bantara Angkatan Terbaru',
                        'tanggal_kegiatan' => '2025-07-20',
                        'foto'             => $galeris[2] ?? null,
                        'deskripsi'        => "Kegiatan perkemahan sabtu-minggu yang mengasah ketahanan fisik, kerja sama regu, dan materi kepramukaan lanjutan.",
                    ]
                ]
            ],
            [
                'nama_eskul' => 'IT & Coding Club (Teknologi)',
                'slug'       => 'it-club',
                'kategori'   => 'Teknologi & Sains',
                'pembina'    => 'Bpk. Hendra Wijaya, M.Kom',
                'ketua'      => 'Farhan Maulana (XII RPL)',
                'jadwal'     => 'Senin & Kamis, 15:30 - 17:30 WIB',
                'tempat'     => 'Laboratorium Rekayasa Perangkat Lunak (Lab RPL)',
                'foto'       => $galeris[3] ?? null,
                'deskripsi'  => "Wadah siswa yang memiliki minat mendalam di bidang web development, mobile apps, robotika IoT, dan cyber security. Mempersiapkan siswa mengikuti lomba LKS dan proyek digital kreatif.",
                'visi_misi'  => "Visi: Mencetak talenta digital muda yang inovatif, kompetitif, dan siap bersaing di industri teknologi informasi.",
                'kegiatans'  => [
                    [
                        'judul'            => 'Workshop Web Development Modern dan Pengenalan AI',
                        'tanggal_kegiatan' => '2025-08-28',
                        'foto'             => $galeris[3] ?? null,
                        'deskripsi'        => "Sesi belajar intensif pembuatan antarmuka web interaktif dan penerapan teknologi AI bersama mentor industri.",
                    ]
                ]
            ],
        ];

        foreach ($eskuls as $data) {
            $kegiatans = $data['kegiatans'] ?? [];
            unset($data['kegiatans']);

            $eskul = Eskul::create($data);

            foreach ($kegiatans as $keg) {
                KegiatanEskul::create([
                    'eskul_id'         => $eskul->id,
                    'judul'            => $keg['judul'],
                    'slug'             => Str::slug($keg['judul']) . '-' . Str::random(4),
                    'tanggal_kegiatan' => $keg['tanggal_kegiatan'],
                    'foto'             => $keg['foto'],
                    'deskripsi'        => $keg['deskripsi'],
                    'user_id'          => $adminUser ? $adminUser->id : null,
                ]);
            }
        }
    }
}
