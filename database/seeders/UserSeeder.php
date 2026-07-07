<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'nama' => 'Syifa Shabrina',
                'email' => 'shabrinadmin@gmail.com',
                'password' => 'Admin123*',
                'peran' => 'Admin',
            ],
            [
                'nama' => 'Syifa Munir',
                'email' => 'syifamunir@gmail.com',
                'password' => 'Wisatawan123*',
                'peran' => 'Wisatawan',
            ],
            [
                'nama' => 'Asysyifa Shabrina',
                'email' => 'shabrina@gmail.com',
                'password' => 'Shabrina123*',
                'peran' => 'Wisatawan',
            ],
            [
                'nama' => 'Nabila Azzahra',
                'email' => 'nabilaazzahra@gmail.com',
                'password' => 'Nabilaaz123*',
                'peran' => 'Wisatawan',
            ],
        ];

        foreach ($userData as $data) {
            User::create([
                'nama' => $data['nama'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'foto' => $data['foto'] ?? null,
                'peran' => $data['peran'],
            ]);
        }
    }
}
