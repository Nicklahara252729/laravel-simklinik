<?php

namespace App\Repositories\MasterData\DataSpesialis;

interface DataSpesialisRepositories
{
    public function data();
    public function store(array $request);
    public function update(array $request, string $uuidDataSpesialis);
    public function get(string $uuidDataSpesialis);
    public function delete(string $uuidDataSpesialis);
}
