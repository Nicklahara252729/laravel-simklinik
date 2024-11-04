<?php

namespace App\Repositories\ListPasien\PasienIgd;

interface PasienIgdRepositories
{
    public function data(string $uuidFaskes);
    public function get(string $uuidPendaftaran, string $uuidFaskes);
}
