<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminData = [
            [
                'nama' => 'Syifa Shabrina',
                'email' => 'shabrinaAdmin@gmail.com',
                'password' => 'admin123',
            ],
        ];

        foreach ($adminData as $data) {
            $user = User::where('email', $data['email'])->first();

            if (!$user) {
                $userAdmin = User::create([
                    'nama' => $data['nama'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'foto' => $data['foto'] ?? null,
                    'peran' => 'Admin',
                ]);

                Admin::create([
                    'user_id' => $userAdmin->id,
                ]);
            }
        }
    }
}
