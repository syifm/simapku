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
                'nama' => 'Layang-Layang Resto',
                'kecamatan' => 'Banyumanik',
                'kelurahan' => 'Ngesrep',
                'alamat' => 'Jl. B. Jaya No.16, Ngesrep, Kec. Banyumanik, Kota Semarang, Jawa Tengah 50261',
                'no_telp' => '08112916162',
                'deskripsi' => 'Resto yang menyajikan makanan nusantara dengan dilengkapi oleh pemandangan kota dari rooftop',
                'foto' => 'hihihihi',
                'latitude' => '-7.044985619474768',
                'longitude' => '110.42868816935768',
                'harga_min' => 50000,
                'harga_max' => 100000,
                'penilaian' => 4,
                'email_pengaju' => 'syif@gmail.com',
                'id_wisatawan' => null,
                'id_admin' => 1,
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
                'deskripsi' => 'Resto yang menyajikan seafood dikelilingi dengan pemandangan air dan diiringi dengan musik.',
                'foto' => 'hihihihi',
                'latitude' => '-6.961944043665627',
                'longitude' => '110.38600824501671',
                'harga_min' => 10000,
                'harga_max' => 20000,
                'penilaian' => 4,
                'email_pengaju' => 'syifa@gmail.com',
                'id_wisatawan' => null,
                'id_admin' => 1,
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
                'no_telp' => $data['no_telp'],
                'deskripsi' => $data['deskripsi'],
                'foto' => $data['foto'],
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude'],
                'harga_min' => $data['harga_min'],
                'harga_max' => $data['harga_max'],
                'penilaian' => $data['penilaian'],
                'email_pengaju' => $data['email_pengaju'],
                'id_wisatawan' => null,
                'id_admin' => $data['id_admin'],
                'status' => $data['status'],
                'jenis_pengajuan' => $data['jenis_pengajuan'],
                'waktu_dibuat' => $data['waktu_dibuat'],
                'waktu_diubah' => $data['waktu_diubah'],
            ]);
        }
    }
}
