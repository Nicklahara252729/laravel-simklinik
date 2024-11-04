<?php

namespace App\Repositories\MasterData\JenisPembayaran;

interface JenisPembayaranRepositories
{
    public function data();
    public function store(array $request);
    public function update(array $request, string $uuidJenisPembayaran);
    public function get(string $uuidJenisPembayaran);
    public function delete(string $uuidJenisPembayaran);
}
