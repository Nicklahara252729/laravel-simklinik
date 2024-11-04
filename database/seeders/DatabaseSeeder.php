<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\FaskesSeeder;
use Database\Seeders\LaboratKategoriSeeder;
use Database\Seeders\TindakanKategoriSeeder;
use Database\Seeders\JenisPembayaranSeeder;
use Database\Seeders\PoliklinikSeeder;
use Database\Seeders\JadwalPoliSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\DataObatSeeder;
use Database\Seeders\LaboratSeeder;
use Database\Seeders\TindakanSeeder;
use Database\Seeders\PendaftaranPasienSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            PoliklinikSeeder::class,
            JenisPembayaranSeeder::class,
            FaskesSeeder::class,
            UserSeeder::class,
            LaboratKategoriSeeder::class,
            LaboratSeeder::class,
            TindakanKategoriSeeder::class,
            TindakanSeeder::class,
            PendaftaranPasienSeeder::class,
            JadwalPoliSeeder::class,
            KlasifikasiObatSeeder::class,
            SatuanObatSeeder::class,
            RoleSeeder::class,
            DataObatSeeder::class,
            SpesialisSeeder::class,
        ]);
    }
}
