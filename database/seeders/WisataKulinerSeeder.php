<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\WisataKuliner;
use Illuminate\Database\Seeder;

class WisataKulinerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wkulinerData = [
            [
                'nama' => 'Layang-Layang Resto',
                'kecamatan' => 'Banyumanik',
                'kelurahan' => 'Ngesrep',
                'alamat' => 'Jl. B. Jaya No.16, Ngesrep, Kec. Banyumanik, Kota Semarang, Jawa Tengah 50261',
                'no_telp' => '08112916162',
                'deskripsi' => 'Resto yang menyajikan makanan nusantara dengan dilengkapi oleh pemandangan kota dari rooftop',
                'foto' => 'layanglayang.png',
                'latitude' => '-7.044985619474768',
                'longitude' => '110.42868816935768',
                'id_wisatawan' => 1,
                'id_admin' => 1,
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                'nama' => 'Pawon Kamari',
                'kecamatan' => 'Tembalang',
                'kelurahan' => 'Tembalang',
                'alamat' => 'Jl. Tembalang Baru No.17, Tembalang, Kec. Tembalang, Kota Semarang, Jawa Tengah 50275',
                'no_telp' => '081399999727',
                'deskripsi' => 'Rumah makan yang menyajikan masakan nusantara dengan tempat yang nyaman dan bersih',
                'foto' => 'pawonkamari.png',
                'latitude' => '-7.055005976603664',
                'longitude' => '110.43501408324121',
                'id_wisatawan' => 2,
                'id_admin' => 1,
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
        ];

        foreach ($wkulinerData as $data) {
            WisataKuliner::create([
                'nama' => $data['nama'],
                'kecamatan' => $data['kecamatan'],
                'kelurahan' => $data['kelurahan'],
                'alamat' => $data['alamat'],
                'no_telp' => $data['no_telp'] ?? null,
                'deskripsi' => $data['deskripsi'],
                'foto' => $data['foto'] ?? null,
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude'],
                'harga_min' => $data['harga_min'] ?? null,
                'harga_max' => $data['harga_max'] ?? null,
                'penilaian' => $data['penilaian'] ?? null,
                'sertifikat_halal' => $data['sertifikat_halal'] ?? 'Belum',
                'id_wisatawan' => $data['id_wisatawan'] ?? null,
                'id_admin' => $data['id_admin'] ?? null,
                'status' => $data['status'] ?? 'Disetujui',
                'status_operasional' => $data['status_operasional'] ?? 'Aktif',
                'waktu_dibuat' => $data['waktu_dibuat'],
                'waktu_diubah' => $data['waktu_diubah'],
            ]);
        }
    }
}
