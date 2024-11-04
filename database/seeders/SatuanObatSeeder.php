<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SatuanObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $satuanObat = [
            'amp',
            'blister',
            'botol',
            'box',
            'buah',
            'bungkus',
            'fls',
            'galon',
            'kaplet',
            'kapsul',
            'kit',
            'kotak',
            'lembar',
            'pack',
            'paket',
            'pcs',
            'pot',
            'rol',
            'sachet',
            'sase',
            'set',
            'strip',
            'supp',
            'tab',
            'tablet',
            'tube',
            'vial',
            'Pritagesic tab',
            'AMPUL',
            'BOTOL 60 ML',
            'SYRUP',
            'BOTOL 500 ML',
            'BOTOL 100 ML',
            'BAG',
            'BIJI',
            'SAK',
            'BOTOL/1 LITER',
            'CAPSUL',
            'BOTOL/KOTAK',
            'PAK',
            'SET/20 LITER',
            'BOTOL 300 ML',
            'BOTOL 1000 ML',
            'BOTOL 10 ML',
            'KANTONG',
            'SET/BOTOL',
            'BIJI/PSG',
            'SET/KANTONG',
            'TUBE 5 G',
            'BOTOL 5 ML',
            'LUSIN',
            'FLES',
            'BOX/50 PCS',
            'TUBE 10 G',
            'OVULA',
            'PAKET/DOS',
            'BOTOL 30 ML',
            'SET @ 30 G',
            'OZ',
            'SET @ 100 G/BTL',
            'LITER',
            'STIK',
        ];

        foreach ($satuanObat as $key => $value):
            \App\Models\MasterData\SatuanObat\SatuanObat::create([
                'satuan' => $value,
            ]);
        endforeach;
    }
}
