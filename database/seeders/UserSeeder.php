<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Carbon;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $getFaskes = \App\Models\MasterData\Faskes\Faskes::first();
        $level = ['superadmin', 'admin faskes', 'operator', 'dokter', 'resepsionis', 'apoteker', 'kasir', 'perawat', 'poli'];

        $faker = Faker::create();
        foreach ($level as $key => $value) :
            $uuidUser = Uuid::uuid4()->getHex();
            \App\Models\User\User::create([
                'uuid_user' => $uuidUser,
                'name' => $faker->name,
                'email' => $faker->email,
                'username' => $value,
                'password' => Hash::make("password"),
                'level' => $value,
                'phone' => $faker->phoneNumber,
                'uuid_faskes' => $value == 'superadmin' ? null : $getFaskes->uuid_faskes,
            ]);

            if ($value != 'superadmin') :
                \App\Models\MasterData\Pegawai\Pegawai\Pegawai::create([
                    'uuid_user' => $uuidUser,
                    'no_ktp' => $faker->numberBetween(000000000000, 999999999999),
                    'no_npwp' => $faker->numberBetween(000000000000, 999999999999),
                    'no_str' => $faker->numberBetween(000000000000, 999999999999),
                    'tgl_berlaku_str' => Carbon::now(),
                    'tgl_berakhir_str' => Carbon::now()->add(30, 'day'),
                    'no_sip' => $faker->numberBetween(000000000000, 999999999999),
                    'tgl_berlaku_sip' => Carbon::now(),
                    'tgl_berakhir_sip' => Carbon::now()->add(30, 'day'),
                ]);
            endif;
        endforeach;
    }
}
