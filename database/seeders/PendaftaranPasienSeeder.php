<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Carbon;

class PendaftaranPasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $getFaskes = \App\Models\MasterData\Faskes\Faskes::first();
        $getPoliklinikLinkKlinik = \App\Models\MasterData\Poliklinik\PoliklinikLinkKlinik\PoliklinikLinkKlinik::first();
        $getJpLinkFaskes = \App\Models\MasterData\JenisPembayaran\JenisPembayaranLinkFaskes\JenisPembayaranLinkFaskes::first();
        $uuidDataPribadi = Uuid::uuid4()->getHex();
        $inputDataPribadi = [
            'no_ktp' => 1276114123142,
            'nama_pasien' => 'Donald Trump',
            'tgl_lahir' => '1980-01-01',
            'alamat' => 'Jl. Kemuning 1',
            'email' => 'donaldtrump@gmail.com',
            'gender' => 'laki - laki',
            'golongan_darah' => 'A',
            'no_hp_1' => '081122334455',
            'uuid_faskes' => $getFaskes->uuid_faskes,
            'uuid_data_pribadi' => $uuidDataPribadi,
            'no_rm' => '000001'
        ];
        \App\Models\Pendaftaran\DataPribadi\DataPribadi::create($inputDataPribadi);

        /**
         * save pendaftaran
         */
        $inputPendaftaran = [
            'uuid_faskes' => $getFaskes->uuid_faskes,
            'uuid_data_pribadi' => $uuidDataPribadi,
            'no_pendaftaran' => '000001',
            'jenis_layanan' => 'rawat jalan',
            'jenis_pelayanan' => 'umum',
            'status' => 0
        ];
        \App\Models\Pendaftaran\Pendaftaran\Pendaftaran::create($inputPendaftaran);

        /**
         * save data penanggung jawab
         */
        $inputDataPj = [
            'nama_pj' => 'Joe Biden',
            'no_hp' => '081122334455',
            'id_provinsi' => '11',
            'id_kabupaten' => '1101',
            'id_kecamatan' => '110101',
            'id_desa' => '1101012001',
            'uuid_data_pribadi' => $uuidDataPribadi
        ];
        \App\Models\Pendaftaran\DataPenanggungJawab\DataPenanggungJawab::create($inputDataPj);

        /**
         * save data pendukung
         */
        $inputDataPendukung = [
            'uuid_poliklinik_link_klinik' => $getPoliklinikLinkKlinik->uuid_poliklinik_link_klinik,
            'kunjungan' => 'sakit',
            'uuid_jp_link_faskes' => $getJpLinkFaskes->uuid_jp_link_faskes,
            'uuid_data_pribadi' => $uuidDataPribadi
        ];
        \App\Models\Pendaftaran\DataPendukung\DataPendukung::create($inputDataPendukung);
    }
}
