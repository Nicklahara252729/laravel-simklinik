<?php

namespace App\Repositories\MasterData\Poli;

interface PoliRepositories
{
    public function data();
    public function store(array $request);
    public function update(array $request, string $uuidTindakan);
    public function get(string $uuidTindakan);
    public function delete(string $uuidTindakan);
}
