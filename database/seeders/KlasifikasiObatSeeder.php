<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class KlasifikasiObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $klasifikasiObat = [
            'Analgesik',
            'Antasida',
            'Anticemas',
            'Anti-aritmia',
            'Antibiotik',
            'Antikoagulan dan trombolitik',
            'Antikonvulsan',
            'Antidepresan',
            'Antidiare',
            'Anti-emetik',
            'Antijamur',
            'Antihistamin',
            'Antihipertensi',
            'Anti-inflamasi',
            'Antineoplastik',
            'Antipsikotik',
            'Antipiretik',
            'Antivirus',
            'Beta-blocker',
            'Bronkodilator',
            'Kortikosteroid',
            'Sitotoksik',
            'Dekongestan',
            'Ekspektoran',
            'Obat tidur',
        ];

        foreach ($klasifikasiObat as $key => $value):
            \App\Models\MasterData\KlasifikasiObat\KlasifikasiObat::create([
                'klasifikasi' => $value,
            ]);
        endforeach;
    }
}
