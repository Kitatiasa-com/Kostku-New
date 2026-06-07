<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PengelolaSeeder::class,
            PenghuniSeeder::class,
            PembayaranSeeder::class,
            SuperAdminSeeder::class,
            RecordSeeder::class,
        ]);
    }
}
