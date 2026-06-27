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
                'id_kategori' => 6,
            ],
            [
                'id_pengajuan' => 1,
                'id_kategori' => 12,
            ],
            [
                'id_pengajuan' => 2,
                'id_kategori' => 5,
            ],
            [
                'id_pengajuan' => 2,
                'id_kategori' => 6,
            ],
            [
                'id_pengajuan' => 2,
                'id_kategori' => 12,
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
