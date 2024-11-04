<?php

namespace App\Repositories\MasterData\Faskes;

interface FaskesRepositories
{
    public function data();
    public function get(string $uuidFaskes);
    public function store(array $request);
    public function update(array $request, string $uuidFaskes);
    public function delete(string $uuidFaskes);
}
