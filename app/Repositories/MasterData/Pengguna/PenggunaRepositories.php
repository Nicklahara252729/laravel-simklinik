<?php

namespace App\Repositories\MasterData\Pengguna;

interface PenggunaRepositories
{
    public function data();
    public function store(array $request);
    public function update(array $request, string $uuidUser);
    public function get(string $uuidUser);
    public function delete(string $uuidUser);
}
