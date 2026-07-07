<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\KulinerFavorit;
use Illuminate\Database\Seeder;

class KulinerFavoritSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kulinerfavoritData = [
            [
                'id_user' => 1,
                'id_wisata_kuliner' => 1,
                'waktu_dibuat' => now(),
            ],
            [
                'id_user' => 1,
                'id_wisata_kuliner' => 3,
                'waktu_dibuat' => now(),
            ],
            [
                'id_user' => 1,
                'id_wisata_kuliner' => 4,
                'waktu_dibuat' => now(),
            ],
        ];

        foreach ($kulinerfavoritData as $data) {
            KulinerFavorit::create([
                'id_user' => $data['id_user'],
                'id_wisata_kuliner' => $data['id_wisata_kuliner'],
                'waktu_dibuat' => $data['waktu_dibuat'],
            ]);
        }
    }
}
