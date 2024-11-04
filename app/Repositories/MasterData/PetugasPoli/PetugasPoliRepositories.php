<?php

namespace App\Repositories\MasterData\PetugasPoli;

interface PetugasPoliRepositories
{
    public function data(string $uuidFaskes);
    public function store(array $request);
    public function update(array $request, string $uuidPetugasPoli);
    public function get(string $uuidPetugasPoli);
    public function delete(string $uuidPetugasPoli);
}
