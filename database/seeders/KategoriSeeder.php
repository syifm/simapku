<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriData = [
            [
                'nama' => 'Indonesia',
                'jenis_kategori' => 'Asal Kuliner',
            ],
            [
                'nama' => 'Sunda',
                'jenis_kategori' => 'Asal Kuliner',
            ],
            [
                'nama' => 'Western',
                'jenis_kategori' => 'Asal Kuliner',
            ],
            [
                'nama' => 'Padang',
                'jenis_kategori' => 'Asal Kuliner',
            ],
            [
                'nama' => 'Jawa',
                'jenis_kategori' => 'Asal Kuliner',
            ],
            [
                'nama' => 'Restoran',
                'jenis_kategori' => 'Tempat',
            ],
            [
                'nama' => 'Kafe',
                'jenis_kategori' => 'Tempat',
            ],
            [
                'nama' => 'Angkringan',
                'jenis_kategori' => 'Tempat',
            ],
            [
                'nama' => 'Seafood',
                'jenis_kategori' => 'Jenis Hidangan',
            ],
            [
                'nama' => 'Minuman',
                'jenis_kategori' => 'Jenis Hidangan',
            ],
            [
                'nama' => 'Makanan Ringan',
                'jenis_kategori' => 'Jenis Hidangan',
            ],
            [
                'nama' => 'Makanan Berat',
                'jenis_kategori' => 'Jenis Hidangan',
            ],
        ];

        foreach ($kategoriData as $data) {
            Kategori::create([
                'nama' => $data['nama'],
                'jenis_kategori' => $data['jenis_kategori'],
                'status' => 'Aktif',
            ]);
        }
    }
}
