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
                'nama' => 'Lawuh Ndeso',
                'kecamatan' => 'Banyumanik',
                'kelurahan' => 'Ngesrep',
                'alamat' => 'Jl. Tembalang Baru IV No.35, Tembalang, Kec. Tembalang, Kota Semarang, Jawa Tengah 50275',
                'no_telp' => '082138064244',
                'deskripsi' => 'Resto yang menyajikan beraneka ragam makanan Jawa yang lezat dan cocok untuk disantap untuk sarapan, makan siang, atau makan malam',
                'foto' => 'lawuhndeso.png',
                'latitude' => '-7.05470398838969',
                'longitude' => '110.43388062311895',
                'id_user' => 2,
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
                'foto' => 'padangju.png',
                'latitude' => '-7.057880566238512',
                'longitude' => '110.42727165248765',
                'id_user' => 2,
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
                'id_user' => $data['id_user'] ?? null,
                'status' => $data['status'],
                'status_operasional' => $data['status_operasional'] ?? 'Aktif',
                'jenis_pengajuan' => $data['jenis_pengajuan'],
                'waktu_dibuat' => $data['waktu_dibuat'],
                'waktu_diubah' => $data['waktu_diubah'],
            ]);
        }
    }
}
