<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\PenilaiandanUlasan;
use Illuminate\Database\Seeder;

class PenilaianDanUlasanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ulasanData = [
            [
                'id_wisata_kuliner' => 1,
                'nilai' => 4,
                'ulasan' => 'Restonya enak dan tempatnya nyaman, cocok untuk makan bersama keluarga. Pilihan makanannya juga banyak, aku suka sekali.',
                'foto_ulasan' => 'foto_ssssss_1770807049.png',
                'email_pengulas' => 'syifmunir@gmail.com',
                'status' => 'Belum Diverifikasi',
                'waktu_dibuat' => '08/10/2025 14:05',
                'waktu_diubah' => '09/10/2025 16:10',
            ],
        ];

        foreach ($ulasanData as $data) {
            PenilaiandanUlasan::create([
                'id_wisata_kuliner' => 1,
                'nilai' => $data['nilai'],
                'ulasan' => $data['ulasan'],
                'foto_ulasan' => $data['foto_ulasan'],
                'email_pengulas' => $data['email_pengulas'],
                'status' => $data['status'],
                'waktu_dibuat' => $data['waktu_dibuat'],
                'waktu_diubah' => $data['waktu_diubah'],
            ]);
        }
    }
}
