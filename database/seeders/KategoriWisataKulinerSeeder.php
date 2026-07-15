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
                'id_kategori' => 1,
            ],
            [
                'id_wisata_kuliner' => 1,
                'id_kategori' => 6,
            ],
            [
                'id_wisata_kuliner' => 1,
                'id_kategori' => 12,
            ],
            [
                'id_wisata_kuliner' => 2,
                'id_kategori' => 1,
            ],
            [
                'id_wisata_kuliner' => 2,
                'id_kategori' => 6,
            ],
            [
                'id_wisata_kuliner' => 2,
                'id_kategori' => 9,
            ],
            [
                'id_wisata_kuliner' => 3,
                'id_kategori' => 3,
            ],
            [
                'id_wisata_kuliner' => 3,
                'id_kategori' => 6,
            ],
            [
                'id_wisata_kuliner' => 3,
                'id_kategori' => 12,
            ],
            [
                'id_wisata_kuliner' => 4,
                'id_kategori' => 1,
            ],
            [
                'id_wisata_kuliner' => 4,
                'id_kategori' => 6,
            ],
            [
                'id_wisata_kuliner' => 4,
                'id_kategori' => 12,
            ],
            [
                'id_wisata_kuliner' => 5,
                'id_kategori' => 5,
            ],
            [
                'id_wisata_kuliner' => 5,
                'id_kategori' => 6,
            ],
            [
                'id_wisata_kuliner' => 5,
                'id_kategori' => 12,
            ],
            [
                'id_wisata_kuliner' => 6,
                'id_kategori' => 1,
            ],
            [
                'id_wisata_kuliner' => 6,
                'id_kategori' => 6,
            ],
            [
                'id_wisata_kuliner' => 6,
                'id_kategori' => 12,
            ],
            [
                'id_wisata_kuliner' => 7,
                'id_kategori' => 5,
            ],
            [
                'id_wisata_kuliner' => 7,
                'id_kategori' => 6,
            ],
            [
                'id_wisata_kuliner' => 7,
                'id_kategori' => 12,
            ],
            [
                'id_wisata_kuliner' => 8,
                'id_kategori' => 1,
            ],
            [
                'id_wisata_kuliner' => 8,
                'id_kategori' => 6,
            ],
            [
                'id_wisata_kuliner' => 8,
                'id_kategori' => 9,
            ],
            [
                'id_wisata_kuliner' => 9,
                'id_kategori' => 1,
            ],
            [
                'id_wisata_kuliner' => 9,
                'id_kategori' => 6,
            ],
            [
                'id_wisata_kuliner' => 9,
                'id_kategori' => 12,
            ],
            [
                'id_wisata_kuliner' => 10,
                'id_kategori' => 1,
            ],
            [
                'id_wisata_kuliner' => 10,
                'id_kategori' => 6,
            ],
            [
                'id_wisata_kuliner' => 10,
                'id_kategori' => 12,
            ],
            [
                'id_wisata_kuliner' => 11,
                'id_kategori' => 4,
            ],
            [
                'id_wisata_kuliner' => 11,
                'id_kategori' => 6,
            ],
            [
                'id_wisata_kuliner' => 11,
                'id_kategori' => 12,
            ],
            [
                'id_wisata_kuliner' => 12,
                'id_kategori' => 3,
            ],
            [
                'id_wisata_kuliner' => 12,
                'id_kategori' => 6,
            ],
            [
                'id_wisata_kuliner' => 12,
                'id_kategori' => 12,
            ],
            [
                'id_wisata_kuliner' => 13,
                'id_kategori' => 5,
            ],
            [
                'id_wisata_kuliner' => 13,
                'id_kategori' => 6,
            ],
            [
                'id_wisata_kuliner' => 13,
                'id_kategori' => 12,
            ],
            [
                'id_wisata_kuliner' => 14,
                'id_kategori' => 5,
            ],
            [
                'id_wisata_kuliner' => 14,
                'id_kategori' => 6,
            ],
            [
                'id_wisata_kuliner' => 14,
                'id_kategori' => 12,
            ],
            [
                'id_wisata_kuliner' => 15,
                'id_kategori' => 5,
            ],
            [
                'id_wisata_kuliner' => 15,
                'id_kategori' => 6,
            ],
            [
                'id_wisata_kuliner' => 15,
                'id_kategori' => 12,
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
