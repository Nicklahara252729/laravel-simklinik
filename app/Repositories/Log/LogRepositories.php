<?php

namespace App\Repositories\Log;

interface LogRepositories
{
    public function saveLog(string $action, string $keterangan, $uuidUser, $nop);
}
