<?php

namespace App\Repositories\MasterData\TindakanKategori;

interface TindakanKategoriRepositories
{
    public function data(string $uuidFaskes);
    public function store(array $request);
    public function update(array $request, string $uuidTindakanKategori);
    public function get(string $uuidTindakanKategori);
    public function delete(string $uuidTindakanKategori);
}
