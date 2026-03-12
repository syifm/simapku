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
                'no_telp' => '(024) 8310620',
                'deskripsi' => 'Straightforward restaurant serving classic Javanese dishes amid bright, traditional decor.',
                'foto' => 'hihihihi',
                'latitude' => '-6.996418149883837',
                'longitude' => '110.41534564234345',
                'penilaian' => 0,
                'email_pengaju' => 'syifa@gmail.com',
                'id_wisatawan' => null,
                'id_admin' => 1,
                'status' => 'Belum Diverifikasi',
                'waktu_dibuat' => '08/10/2025 14:05',
                'waktu_diubah' => '09/10/2025 16:10',
            ],
        ];

        foreach ($wkulinerData as $data) {
            // WisataKuliner::create([
            //     'nama' => $data[0],
            //     'kecamatan' => $data[1],
            //     'kelurahan' => $data[2],
            //     'alamat' => $data[3],
            //     'no_hp' => $data[4],
            //     'foto' => $data[5],
            //     'deskripsi' => $data[6],
            //     'latitude' => $data[7],
            //     'longitude' => $data[8],
            //     'email_pengaju' => $data[9],
            //     'id_wisatawan' => $data[10],
            //     'id_admin' => $data[11],
            //     'status' => $data[12],
            //     'waktu_dibuat' => $data[13],
            //     'waktu_diubah' => $data[14],
            // ]);
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
