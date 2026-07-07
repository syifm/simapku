<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\FasilitasWisataKuliner;
use Illuminate\Database\Seeder;

class FasilitasWisataKulinerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fwkulinerData = [
            [
                'id_wisata_kuliner' => 1,
                'id_fasilitas' => 1,
            ],
            [
                'id_wisata_kuliner' => 1,
                'id_fasilitas' => 2,
            ],
            [
                'id_wisata_kuliner' => 1,
                'id_fasilitas' => 3,
            ],
            [
                'id_wisata_kuliner' => 2,
                'id_fasilitas' => 1,
            ],
            [
                'id_wisata_kuliner' => 2,
                'id_fasilitas' => 2,
            ],
            [
                'id_wisata_kuliner' => 2,
                'id_fasilitas' => 3,
            ],
            [
                'id_wisata_kuliner' => 2,
                'id_fasilitas' => 4,
            ],
            [
                'id_wisata_kuliner' => 3,
                'id_fasilitas' => 1,
            ],
            [
                'id_wisata_kuliner' => 3,
                'id_fasilitas' => 2,
            ],
            [
                'id_wisata_kuliner' => 3,
                'id_fasilitas' => 3,
            ],
            [
                'id_wisata_kuliner' => 3,
                'id_fasilitas' => 4,
            ],
            [
                'id_wisata_kuliner' => 4,
                'id_fasilitas' => 1,
            ],
            [
                'id_wisata_kuliner' => 4,
                'id_fasilitas' => 2,
            ],
        ];

        foreach ($fwkulinerData as $data) {
            FasilitasWisataKuliner::create([
                'id_wisata_kuliner' => $data['id_wisata_kuliner'],
                'id_fasilitas' => $data['id_fasilitas'],
            ]);
        }
    }
}
