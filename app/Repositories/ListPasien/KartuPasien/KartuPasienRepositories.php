<?php

namespace App\Repositories\ListPasien\KartuPasien;

interface KartuPasienRepositories
{
    public function get(string $noRm, string $uuidFaskes);
}
