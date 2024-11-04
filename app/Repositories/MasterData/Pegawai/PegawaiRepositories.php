<?php

namespace App\Repositories\MasterData\Pegawai;

interface PegawaiRepositories
{
    public function data(string $uuidFaskes);
    public function store(array $request);
    public function update(array $request, string $uuidPegawai);
    public function get(string $uuidPegawai, string $uuidFaskes);
    public function delete(string $uuidPegawai, string $uuidFaskes);
}
