<?php

namespace App\Repositories\Poliklinik;

interface PoliklinikRepositories
{
    public function data(string $uuidPoliklinikLinkKlinik, string $uuidFaskes, string $filter);
    public function get(string $uuidPendaftaran, string $uuidFaskes);
    public function storePerawat(array $request);
    public function storeDokter(array $request);
}
