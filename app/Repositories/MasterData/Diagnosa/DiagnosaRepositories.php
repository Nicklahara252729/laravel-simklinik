<?php

namespace App\Repositories\MasterData\Diagnosa;

interface DiagnosaRepositories
{
    public function data();
    public function store(array $request);
    public function update(array $request, string $code);
    public function get(string $code);
    public function delete(string $code);
}
