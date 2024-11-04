<?php

namespace App\Repositories\ListPasien\SuratKeterangan;

interface SuratKeteranganRepositories
{
    public function get(string $noRm, string $uuidFaskes);
}
