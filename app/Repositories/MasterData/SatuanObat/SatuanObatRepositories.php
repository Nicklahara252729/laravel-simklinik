<?php

namespace App\Repositories\MasterData\SatuanObat;

interface SatuanObatRepositories
{
    public function data();
    public function store(array $request);
    public function update(array $request, string $uuidSatuanObat);
    public function get(string $uuidSatuanObat);
    public function delete(string $uuidSatuanObat);
}
