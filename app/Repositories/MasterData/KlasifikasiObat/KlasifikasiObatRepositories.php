<?php

namespace App\Repositories\MasterData\KlasifikasiObat;

interface KlasifikasiObatRepositories
{
    public function data();
    public function store(array $request);
    public function update(array $request, string $uuidKlasifikasiObat);
    public function get(string $uuidKlasifikasiObat);
    public function delete(string $uuidKlasifikasiObat);
}
