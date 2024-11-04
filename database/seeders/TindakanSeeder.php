<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TindakanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $getFaskes = \App\Models\MasterData\Faskes\Faskes::first();
        $tindakanKetegori = \App\Models\MasterData\Tindakan\TindakanKategori\TindakanKategori::get();
        foreach ($tindakanKetegori as $key => $value):
            \App\Models\MasterData\Tindakan\Tindakan\Tindakan::create([
                'uuid_faskes' => $getFaskes->uuid_faskes,
                'nama' => 'Tindakan ' . $value->kategori,
                'kode' => $key,
                'uuid_tindakan_kategori' => $value->uuid_tindakan_kategori,
                'harga' => $key.'0000'
            ]);
        endforeach;
    }
}
