<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TindakanKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tindakanKategori = [
            'Pelayanan Rawat Jalan',
            'Tind. Medis Umum',
            'Tind. Medis Gigi Mulut',
            'Pelayanan KB',
            'Fisiotherapi',
            'Imunisasi',
            'Lab - Kimia Darah',
            'Lab - Serulogi',
            'Lab - Faeces',
            'Lab - Preparat Apus',
            'Lab - Urine',
            'Konsultasi Kesehatan',
            'Pemeriksaan Kesehatan',
            'One Day Care',
            'Pelayanan Rawat Inap',
            'Ibu dan Anak',
            'Pengembangan Pelayanan KIA',
            'Pengembangan Pelayanan P2',
            'Pelayanan Manajemen'
        ];

        $getFaskes = \App\Models\MasterData\Faskes\Faskes::first();
        foreach ($tindakanKategori as $key => $value) :
            \App\Models\MasterData\Tindakan\TindakanKategori\TindakanKategori::create([
                'uuid_faskes' => $getFaskes->uuid_faskes,
                'kategori' => $value,
            ]);
        endforeach;
    }
}
