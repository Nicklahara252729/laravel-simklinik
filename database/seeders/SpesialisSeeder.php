<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SpesialisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $spesialis = [
            'Ahli Gizi',
            'Akupuntur',
            'Apoteker',
            'Bidan',
            'Dokter Bedah',
        ];

        foreach ($spesialis as $key => $value):
            \App\Models\MasterData\DataSpesialis\DataSpesialis::create([
                'spesialis' => $value,
            ]);
        endforeach;
    }
}
