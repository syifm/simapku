<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\PenilaiandanUlasan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'penilaian' => 4,
                'ulasan' => 'Restonya enak dan tempatnya nyaman, cocok untuk makan bersama keluarga. Pilihan makanannya juga banyak, aku suka sekali.',
                'foto_ulasan' => 'foto_ssssss_1770807049.png',
                'harga_min' => '75000',
                'harga_max' => '100000',
                'email_pengulas' => 'syifmunir@gmail.com',
                'status' => 'Belum Diverifikasi',
                'waktu_dibuat' => '08/10/2025 14:05',
                'waktu_diubah' => '09/10/2025 16:10',
            ],
        ];

        // foreach ($ulasanData as $data) {
        //     PenilaiandanUlasan::create([
        //         'id_wisata_kuliner' => 1,
        //         'nilai' => $data['nilai'],
        //         'ulasan' => $data['ulasan'],
        //         'foto_ulasan' => $data['foto_ulasan'],
        //         'email_pengulas' => $data['email_pengulas'],
        //         'status' => $data['status'],
        //         'waktu_dibuat' => $data['waktu_dibuat'],
        //         'waktu_diubah' => $data['waktu_diubah'],
        //     ]);
        // }

        foreach ($ulasanData as $data) {
            PenilaiandanUlasan::create($data);
        }

        $penilaian = DB::table('penilaian_dan_ulasan')
            ->select(
                'id_wisata_kuliner',
                DB::raw('AVG(penilaian) as rata_rata_penilaian')
            )
            ->groupBy('id_wisata_kuliner')
            ->get();

        foreach ($penilaian as $p) {
            DB::table('wisata_kuliner')
                ->where('id_wisata_kuliner', $p->id_wisata_kuliner)
                ->update([
                    'penilaian' => round($p->rata_rata_penilaian, 1),
                ]);
        }
    }
}
