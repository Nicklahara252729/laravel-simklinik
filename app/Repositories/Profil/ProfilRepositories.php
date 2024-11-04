<?php

namespace App\Repositories\Profil;

interface ProfilRepositories
{
    public function data();
    public function resetPassword(object $request, string $uuidUser);
}
