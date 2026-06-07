<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\KategoriWisataKuliner;
use Illuminate\Database\Seeder;

class KategoriWisataKulinerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kwkulinerData = [
            [
                'id_wisata_kuliner' => 1,
                'id_kategori' => 5,
            ],
            [
                'id_wisata_kuliner' => 1,
                'id_kategori' => 11,
            ],
            [
                'id_wisata_kuliner' => 2,
                'id_kategori' => 5,
            ],
            [
                'id_wisata_kuliner' => 2,
                'id_kategori' => 11,
            ],
            [
                'id_wisata_kuliner' => 2,
                'id_kategori' => 1,
            ],
        ];

        foreach ($kwkulinerData as $data) {
            KategoriWisataKuliner::create([
                'id_wisata_kuliner' => $data['id_wisata_kuliner'],
                'id_kategori' => $data['id_kategori'],
            ]);
        }
    }
}
