<?php

namespace App\Repositories\MasterData\Tindakan;

interface TindakanRepositories
{
    public function data(string $uuidPoliLinkKlinik, string $uuidFaskes);
    public function store(array $request);
    public function update(array $request, string $uuidTindakan);
    public function get(string $uuidTindakan);
    public function delete(string $uuidTindakan);
}
