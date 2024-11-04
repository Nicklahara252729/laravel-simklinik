<?php

namespace App\Repositories\MasterData\Kamar;

interface KamarRepositories
{
    public function data(string $uuidFaskes);
    public function dataBed(string $uuidKamar);
    public function get(string $uuidKamar);
    public function store(array $request);
    public function storeBed(array $request);
    public function update(array $request, string $uuidKamar);
    public function delete(string $uuidKamar);
    public function deleteBed(string $uuidBed);
}
