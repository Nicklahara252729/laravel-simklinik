<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class Tindakan implements Rule
{
    protected $uuidFaskes;

    public function __construct($uuidFaskes)
    {
        $this->uuidFaskes = $uuidFaskes;
    }

    public function passes($attribute, $value)
    {
        $uuidFaskes = authAttribute()['role'] == 'superadmin' ? $this->uuidFaskes : authAttribute()['id_faskes'];
        // Ubah nilai value menjadi array jika belum
        $values = is_array($value) ? $value : [$value];

        // Periksa apakah setiap nilai ada dalam tabel data_blok
        foreach ($values as $tindakan) {
            if (!DB::table('tindakan')
                ->where('uuid_tindakan', $tindakan)
                ->where([
                    'uuid_faskes' => $uuidFaskes,
                ])
                ->exists()) {
                return false;
            }
        }

        return true;
    }

    public function message()
    {
        return 'The selected tindakan is invalid.';
    }
}
