<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed demo user accounts for each role.
     */
    public function run(): void
    {
        $users = [
            [
                'nama'     => 'Admin BAAK',
                'username' => 'baak001',
                'email'    => 'baak@siperuka.ac.id',
                'password' => Hash::make('password123'),
                'role'     => 'baak',
            ],
            [
                'nama'     => 'Petugas Satpam',
                'username' => 'satpam001',
                'email'    => 'satpam@siperuka.ac.id',
                'password' => Hash::make('password123'),
                'role'     => 'satpam',
            ],
            [
                'nama'     => 'Mahasiswa Demo',
                'username' => 'mhs001',
                'email'    => 'mahasiswa@siperuka.ac.id',
                'password' => Hash::make('password123'),
                'role'     => 'mahasiswa',
            ],
        ];

        foreach ($users as $data) {
            // Prevent duplicates on re-seed
            User::firstOrCreate(
                ['email' => $data['email']],
                $data,
            );
        }
    }
}
