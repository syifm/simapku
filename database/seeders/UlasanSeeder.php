<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Ulasan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UlasanSeeder extends Seeder
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
                'foto_ulasan' => 'layanglayang2.png',
                'harga_min' => '75000',
                'harga_max' => '100000',
                'id_wisatawan' => 1,
                'status' => 'Belum Diverifikasi',
                'status_penampilan' => 'Tidak Tampil',
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
        ];

        foreach ($ulasanData as $data) {
            Ulasan::create($data);
        }

        $penilaian = DB::table('ulasan')
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
