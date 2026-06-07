<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\PengajuanWisataKuliner;
use Illuminate\Database\Seeder;

class PengajuanWisataKulinerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pwkulinerData = [
            [
                'nama' => 'Aroem Restaurant & Ballroom',
                'kecamatan' => 'Candisari',
                'kelurahan' => 'Kaliwiru',
                'alamat' => 'Jl. Dr. Wahidin No.213, Kaliwiru, Kec. Candisari, Kota Semarang, Jawa Tengah 50253',
                'no_telp' => '082131928899',
                'deskripsi' => 'Restoran yang menyajikan makanan nusantara dan cocok untuk tempat berkumpul dengan keluarga dan teman',
                'foto' => 'aroem.png',
                'latitude' => '-7.022774087325025',
                'longitude' => '110.42094014423976',
                'id_wisatawan' => 1,
                'status' => 'Belum Diverifikasi',
                'jenis_pengajuan' => 'Baru',
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                'nama' => 'Kampung Laut',
                'kecamatan' => 'Semarang Barat',
                'kelurahan' => 'Tawangsari',
                'alamat' => 'Puri Maerokoco Tawang Mas, Jl. Anjasmoro Raya, Tawangsari, Kec. Semarang Barat, Kota Semarang, Jawa Tengah 50144',
                'no_telp' => '088215658240',
                'deskripsi' => 'Resto yang menyajikan seafood dikelilingi dengan pemandangan air dan diiringi dengan musik',
                'foto' => 'kampunglaut.jpg',
                'latitude' => '-6.961944043665627',
                'longitude' => '110.38600824501671',
                'id_wisatawan' => 1,
                'status' => 'Belum Diverifikasi',
                'jenis_pengajuan' => 'Baru',
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                'nama' => 'The Olive Manor by Rustic Market',
                'kecamatan' => 'Mijen',
                'kelurahan' => 'Pesantren',
                'alamat' => 'Kawasan CBD BSB City Barat 1 No 3, Semarang City, Central Java 50212',
                'no_telp' => '085353718478',
                'deskripsi' => 'Resto yang menyajikan western food dengan menyuguhi pemandangan danau hijau serta pemandangan taman lapang hijau yang indah dan cocok untuk bermain',
                'foto' => 'olivemanor.jpeg',
                'latitude' => '-7.0269114101518895',
                'longitude' => '110.32941918443332',
                'id_wisatawan' => 1,
                'status' => 'Belum Diverifikasi',
                'jenis_pengajuan' => 'Baru',
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                'nama' => 'Lawuh Ndeso',
                'kecamatan' => 'Banyumanik',
                'kelurahan' => 'Ngesrep',
                'alamat' => 'Jl. Tembalang Baru IV No.35, Tembalang, Kec. Tembalang, Kota Semarang, Jawa Tengah 50275',
                'no_telp' => '082138064244',
                'deskripsi' => 'Resto yang menyajikan beraneka ragam makanan Jawa yang lezat dan cocok untuk disantap untuk sarapan, makan siang, atau makan malam',
                'foto' => 'lawuhndeso.png',
                'latitude' => '-7.05470398838969',
                'longitude' => '110.43388062311895',
                'id_wisatawan' => 2,
                'status' => 'Belum Diverifikasi',
                'jenis_pengajuan' => 'Baru',
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                'nama' => 'Nasi Kapau Padangju',
                'kecamatan' => 'Banyumanik',
                'kelurahan' => 'Pedalangan',
                'alamat' => 'Jl. Klentengsari, Pedalangan, Kec. Banyumanik, Kota Semarang, Jawa Tengah 50268',
                'no_telp' => '087782728255',
                'deskripsi' => 'Resto padang yang menyediakan masakan padang yang unik dan sangat lezat',
                'latitude' => '-7.057880566238512',
                'longitude' => '110.42727165248765',
                'id_wisatawan' => 2,
                'status' => 'Belum Diverifikasi',
                'jenis_pengajuan' => 'Baru',
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
        ];

        foreach ($pwkulinerData as $data) {
            PengajuanWisataKuliner::create([
                'nama' => $data['nama'],
                'kecamatan' => $data['kecamatan'],
                'kelurahan' => $data['kelurahan'],
                'alamat' => $data['alamat'],
                'no_telp' => $data['no_telp'] ?? null,
                'deskripsi' => $data['deskripsi'],
                'foto' => $data['foto'] ?? null,
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude'],
                'sertifikat_halal' => $data['sertifikat_halal'] ?? 'Belum',
                'id_wisatawan' => $data['id_wisatawan'] ?? null,
                'id_admin' => $data['id_admin'] ?? null,
                'status' => $data['status'],
                'status_operasional' => $data['status_operasional'] ?? 'Aktif',
                'jenis_pengajuan' => $data['jenis_pengajuan'],
                'waktu_dibuat' => $data['waktu_dibuat'],
                'waktu_diubah' => $data['waktu_diubah'],
            ]);
        }
    }
}
