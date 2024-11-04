<?php

namespace App\Repositories\MasterData\JadwalPoli;

interface JadwalPoliRepositories
{
    public function data(string $uuidFaskes);
    public function store(array $request);
    public function update(array $request, string $uuidJadwalPoli);
    public function get(string $uuidJadwalPoli);
    public function delete(string $uuidJadwalPoli);
}
