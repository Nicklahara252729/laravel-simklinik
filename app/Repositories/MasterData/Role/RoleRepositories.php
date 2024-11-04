<?php

namespace App\Repositories\MasterData\Role;

interface RoleRepositories
{
    public function data();
    public function store(array $request);
    public function update(array $request, string $uuidRole);
    public function get(string $uuidRole);
    public function getByLevel(string $level);
    public function delete(string $uuidRole);
}
