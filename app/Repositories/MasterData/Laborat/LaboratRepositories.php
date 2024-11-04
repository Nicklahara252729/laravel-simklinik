<?php

namespace App\Repositories\MasterData\Laborat;

interface LaboratRepositories
{
    public function data(string $uuidFaskes);
    public function store(array $request);
    public function update(array $request, string $uuidLaborat);
    public function get(string $uuidLaborat);
    public function delete(string $uuidLaborat);
}
