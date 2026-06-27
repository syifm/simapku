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
                'id_admin' => 1,
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                'nama' => 'The Olive Manor by Rustic Market',
                'kecamatan' => 'Mijen',
                'kelurahan' => 'Pesantren',
                'alamat' => 'Kawasan CBD BSB City Barat 1 No 3, Kota Semarang, Jawa Tengah 50212',
                'no_telp' => '085353718478',
                'deskripsi' => 'Resto yang menyajikan western food dengan menyuguhi pemandangan danau hijau serta pemandangan taman lapang hijau yang indah dan cocok untuk bermain',
                'foto' => 'olivemanor.jpeg',
                'latitude' => '-7.0269114101518895',
                'longitude' => '110.32941918443332',
                'id_wisatawan' => 1,
                'id_admin' => 1,
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
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
