<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Wisatawan;
use Illuminate\Support\Facades\Hash;

class WisatawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wisatawanData = [
            [
                'nama' => 'Syifa Munir',
                'email' => 'syifamunir@gmail.com',
                'password' => 'wisatawan123',
                'asal_kota' => 'Semarang',
            ],
            [
                'nama' => 'Asysyifa Shabrina',
                'email' => 'shabrina@gmail.com',
                'password' => 'shabrina123',
                'asal_kota' => 'Surabaya',
            ],
            [
                'nama' => 'Nabila Azzahra',
                'email' => 'nabilaazzahra@gmail.com',
                'password' => 'nabilaaz123',
                'asal_kota' => 'Jakarta',
            ],
        ];

        foreach ($wisatawanData as $data) {
            $user = User::where('email', $data['email'])->first();

            if (!$user) {
                $userWisatawan = User::create([
                    'nama' => $data['nama'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'foto' => $data['foto'] ?? null,
                    'peran' => 'Wisatawan',
                ]);

                Wisatawan::create([
                    'user_id' => $userWisatawan->id,
                    'asal_kota' => $data['asal_kota']
                ]);
            }
        }
    }
}
