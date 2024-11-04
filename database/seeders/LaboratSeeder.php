<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LaboratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $getFaskes = \App\Models\MasterData\Faskes\Faskes::first();
        $laboratKategori = \App\Models\MasterData\Laborat\LaboratKategori\LaboratKategori::get();
        foreach ($laboratKategori as $key => $value):
            \App\Models\MasterData\Laborat\Laborat\Laborat::create([
                'uuid_faskes' => $getFaskes->uuid_faskes,
                'nama' => 'Laborat ' . $value->kategori,
                'kode' => $key,
                'uuid_laborat_kategori' => $value->uuid_laborat_kategori,
                'harga' => $key.'0000'
            ]);
        endforeach;
    }
}
