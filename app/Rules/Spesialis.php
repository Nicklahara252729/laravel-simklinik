<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class Spesialis implements Rule
{
    protected $level;
    protected $uuidSpesialis;

    public function __construct($level, $uuidSpesialis)
    {
        $this->level = $level;
        $this->uuidSpesialis = $uuidSpesialis;
    }

    public function passes($attribute, $value)
    {
        // Periksa apakah setiap nilai ada dalam tabel spesialis
        if ($this->level == 'dokter') {
            if (!DB::table('spesialis')
                ->where('uuid_spesialis', $this->uuidSpesialis)
                ->exists()) {
                return false;
            }
        }

        return true;
    }

    public function message()
    {
        return 'uuid spesialis tidak valid';
    }
}
