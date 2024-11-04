<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obat = [
            [
                'nama' => 'IV CATHETER 22 G',
                'uuid_satuan_obat' => '95d0ccbd01d647b69b55e98e9b098dbf',
                'uuid_klasifikasi_obat' => '4f3334dafe4d4f24b9888909dbc951f8',
                'jenis' => 'bhp',
                'harga_satuan' => 100000,
                'tgl_expired' => '2024-01-01',
                'harga_beli' => 9000
            ],
            [
                'nama' => 'IV CATHETER 24 G',
                'uuid_satuan_obat' => '8f85d3e4e2ab4581a35c7d6c580f0e43',
                'uuid_klasifikasi_obat' => '1c2816608feb4580bb879a880f787254',
                'jenis' => 'obat injeksi',
                'harga_satuan' => 100000,
                'tgl_expired' => '2024-01-01',
                'harga_beli' => 9000
            ],
            [
                'nama' => 'ACYCLOVIR CREAM',
                'uuid_satuan_obat' => '22b121cea6c1427db6926e972621e294',
                'uuid_klasifikasi_obat' => '163336477c8c4d419ecb0569d1eeb35d',
                'jenis' => 'reagent',
                'harga_satuan' => 100000,
                'tgl_expired' => '2024-01-01',
                'harga_beli' => 9000
            ],
            [
                'nama' => 'ACYCLOVIR 400 MG TAB',
                'uuid_satuan_obat' => '9b5438acbeea41618e7a7b26935b625c',
                'uuid_klasifikasi_obat' => '85665285b9c74d098d70776b4eb97e03',
                'jenis' => 'vaksin',
                'harga_satuan' => 100000,
                'tgl_expired' => '2024-01-01',
                'harga_beli' => 9000
            ],
            [
                'nama' => 'AIR RAKSA DENTAL USE',
                'uuid_satuan_obat' => '5f696ac7ae6e40d29d50caa2902096b1',
                'uuid_klasifikasi_obat' => '2cd2882cdb2b4379b103b787b06cfbcc',
                'jenis' => 'imunisasi',
                'harga_satuan' => 100000,
                'tgl_expired' => '2024-01-01',
                'harga_beli' => 9000
            ],
        ];

        $getFaskes = \App\Models\MasterData\Faskes\Faskes::first();
        foreach ($obat as $key => $value) :
            \App\Models\MasterData\DataObat\DataObat::create([
                'uuid_faskes' => $getFaskes->uuid_faskes,
                'kode' => '01' . $key,
                'nama' => $value['nama'],
                'uuid_satuan_obat' => $value['uuid_satuan_obat'],
                'uuid_klasifikasi_obat' => $value['uuid_klasifikasi_obat'],
                'jenis' => $value['jenis'],
                'harga_satuan' => $value['harga_satuan'],
                'tgl_expired' => $value['tgl_expired'],
                'no_batch' => 'NB' . $key,
                'harga_beli' => $value['harga_beli'],
            ]);
        endforeach;
    }
}
