<?php

namespace Database\Seeders;

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

        User::create([
            'id_user' => 'U001',
            'nomor_induk' => '198001',
            'nama_lengkap' => 'Guru Demo',
            'role' => 'guru',
            'kelas' => null,
            'email' => 'guru@example.com',
            'password' => 'password123',
        ]);

        User::create([
            'id_user' => 'U002',
            'nomor_induk' => '25001',
            'nama_lengkap' => 'Siswa Demo',
            'role' => 'siswa',
            'kelas' => 'X',
            'email' => 'siswa@example.com',
            'password' => 'password123',
        ]);

        User::create([
            'id_user' => 'U003',
            'nomor_induk' => 'OP001',
            'nama_lengkap' => 'Operator Demo',
            'role' => 'operator',
            'kelas' => null,
            'email' => 'operator@example.com',
            'password' => 'password123',
        ]);
    }
}
