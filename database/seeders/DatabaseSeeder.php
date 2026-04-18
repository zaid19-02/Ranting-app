<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Pilih salah satu, jangan keduanya!
        $this->call([
            UserSeeder::class, // Jika pakai Opsi 1
            // AdminUserSeeder::class, // Jika pakai Opsi 2
            AnggotaSeeder::class,
        ]);
    }
}
