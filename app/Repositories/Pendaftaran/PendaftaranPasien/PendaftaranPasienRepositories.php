<?php

namespace App\Repositories\Pendaftaran\PendaftaranPasien;

interface PendaftaranPasienRepositories
{
    public function get(string $noRm);
    public function storePasienBaruRawatJalan(array $request);
    public function storePasienLamaRawatJalan(array $request);
    public function storePasienBaruIgd(array $request);
    public function storePasienLamaIgd(array $request);
    public function storePasienBaruRawatInap(array $request);
    public function storePasienLamaRawatInap(array $request);
}
