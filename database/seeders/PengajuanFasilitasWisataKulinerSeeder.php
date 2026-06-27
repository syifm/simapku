<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\PengajuanFasilitasWisataKuliner;
use Illuminate\Database\Seeder;

class PengajuanFasilitasWisataKulinerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pfwkulinerData = [
            [
                'id_pengajuan' => 1,
                'id_fasilitas' => 2,
            ],
            [
                'id_pengajuan' => 2,
                'id_fasilitas' => 2,
            ],
        ];

        foreach ($pfwkulinerData as $data) {
            PengajuanFasilitasWisataKuliner::create([
                'id_pengajuan' => $data['id_pengajuan'],
                'id_fasilitas' => $data['id_fasilitas'],
            ]);
        }
    }
}
