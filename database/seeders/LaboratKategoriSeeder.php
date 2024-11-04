<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LaboratKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $laboratKategori = [
            'Pemeriksaan Hematologi',
            'Pemeriksaan Kimia Klinik',
            'Pemeriksaan Serologi dan Imunologi',
            'Pemeriksaan Parasitologi',
            'Pemeriksaan Toxikologi Klinik',
            'Kadar Gula Darah',
            'Lemak Darah',
            'Faal Hati',
            'Faal Ginjal',
            'Lainnya',
            'Pemeriksaan Faeses',
            'Pemeriksaan Urine',
            'Pemeriksaan Mikrobiologi',
        ];

        $getFaskes = \App\Models\MasterData\Faskes\Faskes::first();
        foreach ($laboratKategori as $key => $value) :
            \App\Models\MasterData\Laborat\LaboratKategori\LaboratKategori::create([
                'uuid_faskes' => $getFaskes->uuid_faskes,
                'kategori' => $value,
            ]);
        endforeach;
    }
}
