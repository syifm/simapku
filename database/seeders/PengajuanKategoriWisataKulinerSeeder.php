<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\PengajuanKategoriWisataKuliner;
use Illuminate\Database\Seeder;

class PengajuanKategoriWisataKulinerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pkwkulinerData = [
            [
                'id_pengajuan' => 1,
                'id_kategori' => 5,
            ],
            [
                'id_pengajuan' => 1,
                'id_kategori' => 11,
            ],
            [
                'id_pengajuan' => 1,
                'id_kategori' => 1,
            ],
            [
                'id_pengajuan' => 2,
                'id_kategori' => 5,
            ],
            [
                'id_pengajuan' => 2,
                'id_kategori' => 11,
            ],
            [
                'id_pengajuan' => 2,
                'id_kategori' => 8,
            ],
            [
                'id_pengajuan' => 2,
                'id_kategori' => 1,
            ],
            [
                'id_pengajuan' => 3,
                'id_kategori' => 5,
            ],
            [
                'id_pengajuan' => 3,
                'id_kategori' => 11,
            ],
            [
                'id_pengajuan' => 4,
                'id_kategori' => 5,
            ],
            [
                'id_pengajuan' => 4,
                'id_kategori' => 11,
            ],
            [
                'id_pengajuan' => 5,
                'id_kategori' => 1,
            ],
            [
                'id_pengajuan' => 5,
                'id_kategori' => 11,
            ],
        ];

        foreach ($pkwkulinerData as $data) {
            PengajuanKategoriWisataKuliner::create([
                'id_pengajuan' => $data['id_pengajuan'],
                'id_kategori' => $data['id_kategori'],
            ]);
        }
    }
}
