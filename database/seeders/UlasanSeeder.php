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
                'penilaian' => 5,
                'ulasan' => 'Pemandangannya bagus dan makanannya enak',
                'harga_min' => '50000',
                'harga_max' => '100000',
                'id_user' => 2,
                'status' => 'Disetujui',
                'status_penampilan' => 'Tampil',
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                'id_wisata_kuliner' => 2,
                'penilaian' => 4,
                'ulasan' => 'Tempat dan pemandangannya bagus sekalii. Ramah anak dan juga makanannya enak-enak',
                'harga_min' => '100000',
                'harga_max' => '200000',
                'id_user' => 2,
                'status' => 'Disetujui',
                'status_penampilan' => 'Tampil',
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                'id_wisata_kuliner' => 3,
                'penilaian' => 5,
                'ulasan' => 'Sejuk dan pemandangannya bagus dekat danau dan ada lapangan luasnya juga. Cocok untuk makan bersama keluarga dan anak-anak',
                'harga_min' => '75000',
                'harga_max' => '100000',
                'id_user' => 2,
                'status' => 'Disetujui',
                'status_penampilan' => 'Tampil',
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                'id_wisata_kuliner' => 3,
                'penilaian' => 4,
                'ulasan' => 'sasfasasdassdasdw',
                'harga_min' => '75000',
                'harga_max' => '125000',
                'id_user' => 2,
                'status' => 'Ditolak',
                'status_penampilan' => 'Tampil',
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                'id_wisata_kuliner' => 4,
                'penilaian' => 4,
                'ulasan' => 'Tempatnya sangat nyaman, dingin, dan makanannya juga enak. Lokasinya juga strategis sekali dekat dengan kantor',
                'harga_min' => '75000',
                'harga_max' => '200000',
                'id_user' => 2,
                'status' => 'Disetujui',
                'status_penampilan' => 'Tampil',
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                'id_wisata_kuliner' => 5,
                'penilaian' => 5,
                'ulasan' => 'Tempatnya nyaman, pemandangan bagus, dan makanannya enak.',
                'harga_min' => '25000',
                'harga_max' => '50000',
                'id_user' => 2,
                'status' => 'Disetujui',
                'status_penampilan' => 'Tampil',
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                'id_wisata_kuliner' => 6,
                'penilaian' => 4,
                'ulasan' => 'Makanannya enak saya suka',
                'harga_min' => '25000',
                'harga_max' => '50000',
                'id_user' => 2,
                'status' => 'Disetujui',
                'status_penampilan' => 'Tampil',
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                'id_wisata_kuliner' => 7,
                'penilaian' => 4,
                'ulasan' => 'Tempatnya sangat nyaman, dingin, dan makanannya juga enak. Lokasinya juga strategis sekali dekat dengan kantor',
                'harga_min' => '25000',
                'harga_max' => '50000',
                'id_user' => 2,
                'status' => 'Disetujui',
                'status_penampilan' => 'Tampil',
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                'id_wisata_kuliner' => 8,
                'penilaian' => 5,
                'ulasan' => 'Seafoodnya segar jadi enak dimakan dan pemandangan bagus',
                'harga_min' => '25000',
                'harga_max' => '125000',
                'id_user' => 3,
                'status' => 'Disetujui',
                'status_penampilan' => 'Tampil',
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                'id_wisata_kuliner' => 9,
                'penilaian' => 5,
                'ulasan' => 'Tempatnya sangat nyaman dan bagus buat foto-foto',
                'harga_min' => '50000',
                'harga_max' => '150000',
                'id_user' => 3,
                'status' => 'Disetujui',
                'status_penampilan' => 'Tampil',
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                'id_wisata_kuliner' => 10,
                'penilaian' => 4,
                'ulasan' => 'Enak sekali akan berkunjung lagi',
                'harga_min' => '25000',
                'harga_max' => '50000',
                'id_user' => 2,
                'status' => 'Disetujui',
                'status_penampilan' => 'Tampil',
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                'id_wisata_kuliner' => 11,
                'penilaian' => 5,
                'ulasan' => 'Enak sekali makanannya',
                'harga_min' => '25000',
                'harga_max' => '50000',
                'id_user' => 2,
                'status' => 'Disetujui',
                'status_penampilan' => 'Tampil',
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                'id_wisata_kuliner' => 12,
                'penilaian' => 4,
                'ulasan' => 'Tempatnya nyaman dan makanannya juga enak, cocok untuk makan bersama anak dan keluarga',
                'harga_min' => '25000',
                'harga_max' => '100000',
                'id_user' => 2,
                'status' => 'Disetujui',
                'status_penampilan' => 'Tampil',
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                'id_wisata_kuliner' => 13,
                'penilaian' => 5,
                'ulasan' => 'Enak sekali makanannya, cocok untuk mahasiswa',
                'harga_min' => '25000',
                'harga_max' => '50000',
                'id_user' => 2,
                'status' => 'Disetujui',
                'status_penampilan' => 'Tampil',
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                'id_wisata_kuliner' => 14,
                'penilaian' => 5,
                'ulasan' => 'Tempatnya nyaman, banyak variasi makanan, dan makanannya enak sekali',
                'harga_min' => '25000',
                'harga_max' => '50000',
                'id_user' => 2,
                'status' => 'Disetujui',
                'status_penampilan' => 'Tampil',
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                'id_wisata_kuliner' => 15,
                'penilaian' => 4,
                'ulasan' => 'Mantap makanannya enak saya suka',
                'harga_min' => '25000',
                'harga_max' => '50000',
                'id_user' => 4,
                'status' => 'Disetujui',
                'status_penampilan' => 'Tampil',
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
        ];

        foreach ($ulasanData as $data) {
            Ulasan::create($data);
        }

        // $penilaian = DB::table('ulasan')
        //     ->select(
        //         'id_wisata_kuliner',
        //         DB::raw('AVG(penilaian) as rata_rata_penilaian')
        //     )
        //     ->groupBy('id_wisata_kuliner')
        //     ->get();

        // foreach ($penilaian as $p) {
        //     DB::table('wisata_kuliner')
        //         ->where('id_wisata_kuliner', $p->id_wisata_kuliner)
        //         ->update([
        //             'penilaian' => round($p->rata_rata_penilaian, 1),
        //         ]);
        // }
        $dataUpdate = DB::table('ulasan')
            ->select(
                'id_wisata_kuliner',
                DB::raw('AVG(penilaian) as rata_rata_penilaian'),
                DB::raw('MIN(harga_min) as harga_min'),
                DB::raw('MAX(harga_max) as harga_max')
            )
            ->where('status', 'Disetujui')
            ->where('status_penampilan', 'Tampil')
            ->groupBy('id_wisata_kuliner')
            ->get();

        foreach ($dataUpdate as $p) {
            DB::table('wisata_kuliner')
                ->where('id_wisata_kuliner', $p->id_wisata_kuliner)
                ->update([
                    'penilaian' => round($p->rata_rata_penilaian, 1),
                    'harga_min' => $p->harga_min,
                    'harga_max' => $p->harga_max,
                ]);
        }
    }
}
