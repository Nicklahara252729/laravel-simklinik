<?php

namespace Database\Seeders\v1;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $id_superadmin = Uuid::uuid4()->getHex();
        \App\Models\V1\Profile::factory()->create([
            'id' => $id_superadmin,
            'profile_name' => 'superadmin'
        ]);

        $id_doctor = Uuid::uuid4()->getHex();
        \App\Models\V1\Profile::factory()->create([
            'id' => $id_doctor,
            'profile_name' => 'doctor'
        ]);

        $id_operator = Uuid::uuid4()->getHex();
        \App\Models\V1\Profile::factory()->create([
            'id' => $id_operator,
            'profile_name' => 'operator'
        ]);

        $id_pasien = Uuid::uuid4()->getHex();
        \App\Models\V1\Profile::factory()->create([
            'id' => $id_pasien,
            'profile_name' => 'pasien'
        ]);

        $admin = Uuid::uuid4()->getHex();
        \App\Models\V1\Profile::factory()->create([
            'id' => $admin,
            'profile_name' => 'admin'
        ]);

        $pemilik = Uuid::uuid4()->getHex();
        \App\Models\V1\Profile::factory()->create([
            'id' => $pemilik,
            'profile_name' => 'pemilik'
        ]);

        $id_user = Uuid::uuid4()->getHex();
        \App\Models\V1\User::factory()->create([
            'id' => $id_user,
            'name' => 'Infotech Metrodata',
            'email' => 'metrodata@gmail.com',
            'username' => 'metrodata',
            'password' => Hash::make("123456"),
            'id_profile' => $id_superadmin,
            'phone' => '081234567890'
        ]);

        $id_clinic = Uuid::uuid4()->getHex();
        \App\Models\V1\Clinic::factory()->create([
            "id" => $id_clinic,
            "clinic_name" => "Metro-Klinik",
            "registered_by" => "System",
            "licence_duration" => 365,
            "address" => "Alamat",
            "logo" => "clinic-default.png"
        ]);


        // \App\Models\V1\User::factory(10)->create();

        // \App\Models\V1\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
