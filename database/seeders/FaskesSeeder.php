<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class FaskesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * save faskes
         */
        $uuidFaskes = Uuid::uuid4()->getHex();
        \App\Models\MasterData\Faskes\Faskes::create([
            'uuid_faskes' => $uuidFaskes,
            'nama' => 'Metro Data Faskes',
            'kode' => '11250909',
            'no_faskes' => '01',
            'id_provinsi' => 11,
            'id_kabupaten' => 1101,
            'id_kecamatan' => 110101,
            'id_desa' => 1101012001,
            'alamat' => 'Jl. Gatot Subroto',
            'kode_pos' => 57711,
            'counter_pasien' => 60825,
            'counter_kk' => 1,
            'latitude' => '-7.67940',
            'longitude' => '111.41729',
            'uuid_user' => '23448219b8fe44ab96bc6fe7cd51a6bb',
        ]);

        /**
         * save poliklinik
         */
        $poliklinik = \App\Models\MasterData\Poliklinik\Poliklinik\Poliklinik::limit(5)->get();
        foreach ($poliklinik as $key => $value) :
            \App\Models\MasterData\Poliklinik\PoliklinikLinkKlinik\PoliklinikLinkKlinik::create([
                'uuid_faskes' => $uuidFaskes,
                'uuid_poliklinik' => $value->uuid_poliklinik
            ]);
        endforeach;

        /**
         * save jenis pembayaran
         */
        $jenisPembayaran = \App\Models\MasterData\JenisPembayaran\JenisPembayaran\JenisPembayaran::limit(5)->get();
        foreach ($jenisPembayaran as $key => $value) :
            \App\Models\MasterData\JenisPembayaran\JenisPembayaranLinkFaskes\JenisPembayaranLinkFaskes::create([
                'uuid_jp_link_faskes' => Uuid::uuid4()->getHex(),
                'uuid_jenis_pembayaran' => $value->uuid_jenis_pembayaran,
                'uuid_faskes' => $uuidFaskes
            ]);
        endforeach;
    }
}
