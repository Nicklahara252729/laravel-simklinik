<?php

namespace App\Repositories\MasterData\LaboratKategori;

interface LaboratKategoriRepositories
{
    public function data(string $uuidFaskes);
    public function store(array $request);
    public function update(array $request, string $uuidLaboratKategori);
    public function get(string $uuidLaboratKategori);
    public function delete(string $uuidLaboratKategori);
}
