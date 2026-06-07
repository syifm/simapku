<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Fasilitas;
use Illuminate\Database\Seeder;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fasilitasData = [
            [
                'nama' => 'Area Parkir',
            ],
            [
                'nama' => 'Toilet',
            ],
            [
                'nama' => 'Mushola',
            ],
            [
                'nama' => 'Wi-Fi',
            ],
            [
                'nama' => 'AC',
            ],
            [
                'nama' => 'Stop Kontak',
            ],
            [
                'nama' => 'Area Bermain Anak',
            ],
        ];

        foreach ($fasilitasData as $data) {
            Fasilitas::create([
                'nama' => $data['nama'],
                'status' => 'Aktif',
            ]);
        }
    }
}
