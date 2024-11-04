<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PoliklinikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $poliklinik = [
            'Klinik Umum',
            'Klinik KIA',
            'Klinik Gigi',
            'Laboratorium',
            'UGD',
            'Rawat Inap',
            'Klinik MTBS',
            'Klinik Gizi',
            'Klinik Lansia',
            'Klinik DDTK',
            'Klinik IMS & VCT',
            'Klinik IVA',
            'Klinik Imunisasi',
            'Klinik KB',
            'Klinik Sanitasi',
            'Klinik Kesling',
            'Klinik Fisioterapi',
            'Klinik Mata'
        ];

        foreach ($poliklinik as $key => $value) :
            \App\Models\MasterData\Poliklinik\Poliklinik\Poliklinik::create([
                'poliklinik' => $value,
            ]);
        endforeach;
    }
}
