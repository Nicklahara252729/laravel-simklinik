<?php

namespace App\Repositories\MasterData\DataObat;

interface DataObatRepositories
{
    public function data(string $uuidFaskes);
    public function store(array $request);
    public function update(array $request, string $uuidDataObat);
    public function get(string $uuidDataObat);
    public function delete(string $uuidDataObat);
}
