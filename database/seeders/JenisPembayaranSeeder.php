<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisPembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisPembayaran = [
            'UMUM / SWADAYA',
            'SKTM',
            'BPJS PBI',
            'BPJS NON PBI',
            'BPJS NON PBI ASKES',
            'JAMKESDA',
            'UKS',
            'FDC',
            'MDT',
            'POSYANDU',
            'GRATIS LAINNYA',
            'BERBAYAR (Rp 10.000,-)',
            'BERBAYAR (Rp 20.000,-)',
            'KIR',
            'UMUM DALAM WILAYAH',
        ];

        foreach ($jenisPembayaran as $key => $value) :
            \App\Models\MasterData\JenisPembayaran\JenisPembayaran\JenisPembayaran::create([
                'jenis_pembayaran' => $value,
            ]);
        endforeach;
    }
}
