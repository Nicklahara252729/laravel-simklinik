<?php

namespace App\Repositories\ListPasien\PasienRawatInap;

interface PasienRawatInapRepositories
{
    public function data(string $uuidFaskes);
    public function get(string $uuidPendaftaran, string $uuidFaskes);
}
