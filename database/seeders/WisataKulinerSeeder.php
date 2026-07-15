<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\WisataKuliner;
use Illuminate\Database\Seeder;

class WisataKulinerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wkulinerData = [
            [
                // 1
                'nama' => 'Layang-Layang Resto',
                'kecamatan' => 'Banyumanik',
                'kelurahan' => 'Ngesrep',
                'alamat' => 'Jl. B. Jaya No.16, Ngesrep, Kec. Banyumanik, Kota Semarang, Jawa Tengah 50261',
                'no_telp' => '08112916162',
                'deskripsi' => 'Resto yang menyajikan makanan nusantara dengan dilengkapi oleh pemandangan kota dari rooftop',
                'foto' => 'layanglayang.png',
                'latitude' => '-7.044985619474768',
                'longitude' => '110.42868816935768',
                'id_user' => 1,
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                // 2
                'nama' => 'Kampung Laut',
                'kecamatan' => 'Semarang Barat',
                'kelurahan' => 'Tawangsari',
                'alamat' => 'Puri Maerokoco Tawang Mas, Jl. Anjasmoro Raya, Tawangsari, Kec. Semarang Barat, Kota Semarang, Jawa Tengah 50144',
                'no_telp' => '088215658240',
                'deskripsi' => 'Resto yang menyajikan seafood dikelilingi dengan pemandangan air dan diiringi dengan musik',
                'foto' => 'kampunglaut.jpg',
                'latitude' => '-6.961944043665627',
                'longitude' => '110.38600824501671',
                'id_user' => 1,
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                // 3
                'nama' => 'The Olive Manor by Rustic Market',
                'kecamatan' => 'Mijen',
                'kelurahan' => 'Pesantren',
                'alamat' => 'Kawasan CBD BSB City Barat 1 No 3, Kota Semarang, Jawa Tengah 50212',
                'no_telp' => '085353718478',
                'deskripsi' => 'Resto yang menyajikan western food dengan menyuguhi pemandangan danau hijau serta pemandangan taman lapang hijau yang indah dan cocok untuk bermain',
                'foto' => 'olivemanor.jpeg',
                'latitude' => '-7.0269114101518895',
                'longitude' => '110.32941918443332',
                'id_user' => 1,
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                // 4
                'nama' => 'Aroem Restaurant & Ballroom',
                'kecamatan' => 'Candisari',
                'kelurahan' => 'Kaliwiru',
                'alamat' => 'Jl. Dr. Wahidin No.213, Kaliwiru, Kec. Candisari, Kota Semarang, Jawa Tengah 50253',
                'no_telp' => '082131928899',
                'deskripsi' => 'Restoran yang menyajikan makanan nusantara dan cocok untuk tempat berkumpul dengan keluarga dan teman',
                'foto' => 'aroem.png',
                'latitude' => '-7.029050249089229',
                'longitude' => '110.33146806193169',
                'id_user' => 1,
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                // 5
                'nama' => 'Kopi Blirik',
                'kecamatan' => 'Mijen',
                'kelurahan' => 'Ngadirgo',
                'alamat' => 'Jl. Padaan, Ngadirgo, Kec. Mijen, Kota Semarang, Jawa Tengah 50213',
                'no_telp' => '08122747576',
                'deskripsi' => 'Tempat makan dengan pemandangan sawah yang menyejukkan dan menyediakan makanan rumahan yang lezat',
                'foto' => 'kopiblirik.jpg',
                'latitude' => '-7.02656459805995',
                'longitude' => '110.30593843181177',
                'id_user' => 1,
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                // 6
                'nama' => 'Maari Resto Nusantara',
                'kecamatan' => 'Mijen',
                'kelurahan' => 'Pesantren',
                'alamat' => 'Jl. BSB Boulevard, Pesantren, Kec. Mijen, Kota Semarang, Jawa Tengah 50212',
                'no_telp' => '085199627007',
                'deskripsi' => 'Resto yang menyediakan makanan nusantara dengan pemandangan danau yang menyejukkan dan indah',
                'foto' => 'maari.jpg',
                'latitude' => '-7.027100067619839',
                'longitude' => '110.3318811062364',
                'id_user' => 1,
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                // 7
                'nama' => 'Lawuh Ndeso',
                'kecamatan' => 'Banyumanik',
                'kelurahan' => 'Ngesrep',
                'alamat' => 'Jl. Tembalang Baru IV No.35, Tembalang, Kec. Tembalang, Kota Semarang, Jawa Tengah 50275',
                'no_telp' => '082138064244',
                'deskripsi' => 'Resto yang menyajikan beraneka ragam makanan Jawa',
                'foto' => 'lawuhndeso.png',
                'latitude' => '-7.0549251257752665',
                'longitude' => '110.433560824099',
                'id_user' => 1,
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                // 8
                'nama' => 'Gama Candi Resto',
                'kecamatan' => 'Mijen',
                'kelurahan' => 'Pesantren',
                'alamat' => 'Jalan West CBD 1 No.3, Pesantren, Kec. Mijen, Kota Semarang, Jawa Tengah 50212',
                'no_telp' => '02476670506',
                'deskripsi' => 'Resto yang menyediakan hidangan seafood yang lezat dan dilengkapi juga dengan permainan anak',
                'foto' => 'gama.jpg',
                'latitude' => '-7.022774087325025',
                'longitude' => '110.42094014423976',
                'id_user' => 1,
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                // 9
                'nama' => 'Terrata Social Dining',
                'kecamatan' => 'Tembalang',
                'kelurahan' => 'Kramas',
                'alamat' => 'Jl. Mulawarman II, Kramas, Kec. Tembalang, Kota Semarang, Jawa Tengah 50278',
                'no_telp' => '081111102997',
                'deskripsi' => 'Resto yang menyajikan hidangan berkualitas dengan suasana hangat dan nyaman, cocok untuk menikmati waktu bersama keluarga, teman, maupun pasangan.',
                'foto' => 'terrata.jpg',
                'latitude' => '-7.067157852423461',
                'longitude' => '110.43562380962511',
                'id_user' => 1,
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                // 10
                'nama' => 'Kedai Tinari',
                'kecamatan' => 'Banyumanik',
                'kelurahan' => 'Pedalangan',
                'alamat' => 'Jl. Sawunggaling III No.44, Pedalangan, Kec. Banyumanik, Kota Semarang, Jawa Tengah 50268',
                'no_telp' => '081918213421',
                'deskripsi' => 'Kedai yang menyajikan bakmi creamy dengan cita rasa khas, cocok untuk pecinta olahan mi yang gurih dan lezat.',
                'foto' => 'kedaitinari.jpg',
                'latitude' => '-7.069145400659661',
                'longitude' => '110.4330100559688',
                'id_user' => 1,
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                // 11
                'nama' => 'Nasi Kapau Padangju',
                'kecamatan' => 'Banyumanik',
                'kelurahan' => 'Pedalangan',
                'alamat' => 'Jl. Klentengsari, Pedalangan, Kec. Banyumanik, Kota Semarang, Jawa Tengah 50268',
                'no_telp' => '087782728255',
                'deskripsi' => 'Rumah makan yang menyajikan aneka hidangan khas Padang, termasuk nasi kapau dengan cita rasa autentik dan pilihan lauk yang beragam.',
                'foto' => 'padangju.jpg',
                'latitude' => '-7.058001062209807',
                'longitude' => '110.42809400930368',
                'id_user' => 1,
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                // 12
                'nama' => 'Koenang-Koenang',
                'kecamatan' => 'Banyumanik',
                'kelurahan' => 'Pedalangan',
                'alamat' => 'Jl. Estetika Raya, Pedalangan, Kec. Banyumanik, Kota Semarang, Jawa Tengah 50268',
                'no_telp' => '02476918555',
                'deskripsi' => 'Resto yang menyajikan beragam hidangan dengan suasana asri, dikelilingi kolam, pepohonan, dan pemandangan alam yang menenangkan.',
                'foto' => 'koenangkoenang.jpg',
                'latitude' => '-7.062681677037204',
                'longitude' => '110.43359154105846',
                'id_user' => 1,
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                // 13
                'nama' => 'Penyet Bu Nur',
                'kecamatan' => 'Tembalang',
                'kelurahan' => 'Bulusan',
                'alamat' => 'Jl. Mulawarman Utara Dalam II, Bulusan, Kec. Tembalang, Kota Semarang, Jawa Tengah 50277',
                'no_telp' => '081328448929',
                'deskripsi' => 'Rumah makan yang menyajikan aneka hidangan penyetan dan masakan khas Jawa dengan cita rasa yang khas dan menggugah selera.',
                'foto' => 'penyetbunur.jpg',
                'latitude' => '-7.066678074875676',
                'longitude' => '110.44073096132406',
                'id_user' => 1,
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                // 14
                'nama' => 'Lombok Idjo Setiabudi',
                'kecamatan' => 'Banyumanik',
                'kelurahan' => 'Tinjomoyo',
                'alamat' => 'Jl. Setia Budi No.63 A, Tinjomoyo, Kec. Banyumanik, Kota Semarang, Jawa Tengah 50262',
                'no_telp' => '08112886974',
                'deskripsi' => 'Restoran yang menyajikan aneka masakan khas Jawa dengan beragam pilihan sambal dan menu penyetan yang menggugah selera.',
                'foto' => 'lombokidjo.jpg',
                'latitude' => '-7.044175030495491',
                'longitude' => '110.42438129299191',
                'id_user' => 1,
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
            [
                // 15
                'nama' => 'Nasi Ayam Bu Pini',
                'kecamatan' => 'Semarang Tengah',
                'kelurahan' => 'Kranggan',
                'alamat' => 'Gg. Pinggir No.75, Kranggan, Kec. Semarang Tengah, Kota Semarang, Jawa Tengah 50139',
                'no_telp' => '081326338833',
                'deskripsi' => 'Warung yang menyajikan kombinasi nasi gurih, sayur labu siam, dan suwiran ayam dengan kuah santan yang kental khas Semarang dengan cita rasa yang dominan gurih dan sedikit manis.',
                'foto' => 'nasiayambupini.jpg',
                'latitude' => '-6.976622608763013',
                'longitude' => '110.42882126051836',
                'id_user' => 1,
                'waktu_dibuat' => now(),
                'waktu_diubah' => now(),
            ],
        ];

        foreach ($wkulinerData as $data) {
            WisataKuliner::create([
                'nama' => $data['nama'],
                'kecamatan' => $data['kecamatan'],
                'kelurahan' => $data['kelurahan'],
                'alamat' => $data['alamat'],
                'no_telp' => $data['no_telp'] ?? null,
                'deskripsi' => $data['deskripsi'],
                'foto' => $data['foto'] ?? null,
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude'],
                'harga_min' => $data['harga_min'] ?? null,
                'harga_max' => $data['harga_max'] ?? null,
                'penilaian' => $data['penilaian'] ?? null,
                'sertifikat_halal' => $data['sertifikat_halal'] ?? 'Belum',
                'id_user' => $data['id_user'] ?? null,
                'status_operasional' => $data['status_operasional'] ?? 'Aktif',
                'waktu_dibuat' => $data['waktu_dibuat'],
                'waktu_diubah' => $data['waktu_diubah'],
            ]);
        }
    }
}
