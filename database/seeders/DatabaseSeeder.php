<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Gunakan updateOrCreate agar tidak terjadi error Duplicate Entry
        
        // Data Admin
        User::updateOrCreate(
            ['email' => 'admin@example.com'], // Cek apakah email ini sudah ada
            [
                'name' => 'Admin Diskominfotik',
                'password' => Hash::make('admin123'), // Pastikan password terenkripsi
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Data User Biasa
        User::updateOrCreate(
            ['email' => 'user@example.com'], // Cek apakah email ini sudah ada
            [
                'name' => 'User Biasa',
                'password' => Hash::make('user123'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]
        );
    }
}