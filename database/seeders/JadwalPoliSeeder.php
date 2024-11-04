<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Helpers\CheckerHelpers;
use Ramsey\Uuid\Uuid;

class JadwalPoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $getFaskes = \App\Models\MasterData\Faskes\Faskes::first();
        $getDokter = $this->getUser(['level' => 'dokter'], true);
        $getPerawat = $this->getUser(['level' => 'perawat'], true);
        $days = daysAttribute();
        foreach ($days as $key => $value) :
            $getPoliklinik = \App\Models\MasterData\Poliklinik\Poliklinik\Poliklinik::limit(5)->get();
            foreach ($getPoliklinik as $key => $valuePoli) :
                \App\Models\MasterData\JadwalPoli\JadwalPoli::create([
                    'uuid_faskes' => $getFaskes->uuid_faskes,
                    'uuid_poliklinik' => $valuePoli->uuid_poliklinik,
                    'uuid_jadwal_poli' => Uuid::uuid4()->getHex(),
                    'dokter' => $getDokter->uuid_user,
                    'perawat' => $getPerawat->uuid_user,
                    'hari' => $value,
                    'jam' => '07:00 - 12:00',
                    'keterangan' => 'bersama koas',
                    'kode_antrian' => $key,
                ]);
            endforeach;
        endforeach;
    }

    /**
     * check user
     */
    private function getUser($data){
        $data = \App\Models\User\User::join('pegawai', 'pegawai.uuid_user', '=', 'users.uuid_user')
                ->where($data)
                ->first();
        return $data;
    }
}
