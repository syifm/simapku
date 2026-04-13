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
                'nama' => 'Pesta Keboen',
                'kecamatan' => 'Gajahmungkur',
                'kelurahan' => 'Lempongsari',
                'alamat' => 'Jl. Veteran No.29, Lempongsari, Kec. Gajahmungkur, Kota Semarang, Jawa Tengah 50231',
                'no_telp' => '0248310620',
                'deskripsi' => 'Straightforward restaurant serving classic Javanese dishes amid bright, traditional decor.',
                'foto' => 'hihihihi',
                'latitude' => '-6.996418149883837',
                'longitude' => '110.41534564234345',
                'harga_min' => 10000,
                'harga_max' => 20000,
                'penilaian' => 4,
                'email_pengaju' => 'syifa@gmail.com',
                'id_wisatawan' => null,
                'id_admin' => 1,
                'status' => 'Belum Diverifikasi',
                'waktu_dibuat' => '08/10/2025 14:05',
                'waktu_diubah' => '09/10/2025 16:10',
            ],
        ];

        foreach ($wkulinerData as $data) {
            WisataKuliner::create([
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
                'waktu_dibuat' => $data['waktu_dibuat'],
                'waktu_diubah' => $data['waktu_diubah'],
            ]);
        }
    }
}
