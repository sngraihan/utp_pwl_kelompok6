<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Perusahaan;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        $perusahaanUser = User::create([
            'name' => 'PT Teknologi Hebat',
            'email' => 'perusahaan@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'perusahaan',
        ]);

        Perusahaan::create([
            'nama' => 'PT Teknologi Hebat',
            'alamat' => 'Jl. Pahlawan No. 42, Kemiling',
            'pic' => 'Dwi Sakethi',
            'kontak' => '081234567890',
            'owner_user_id' => $perusahaanUser->id,
        ]);

        User::create([
            'name' => 'Mahasiswa',
            'email' => 'mahasiswa@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'user',
        ]);
    }
}
