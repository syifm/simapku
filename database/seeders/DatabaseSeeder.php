<?php

namespace Database\Seeders;

use App\Models\Fasilitas;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            UserSeeder::class,
            // PengajuanWisataKulinerSeeder::class,
            WisataKulinerSeeder::class,
            KategoriSeeder::class,
            FasilitasSeeder::class,
            // PengajuanKategoriWisataKulinerSeeder::class,
            // PengajuanFasilitasWisataKulinerSeeder::class,
            KategoriWisataKulinerSeeder::class,
            FasilitasWisataKulinerSeeder::class,
            KulinerFavoritSeeder::class,
            UlasanSeeder::class,
        ]);
    }
}
