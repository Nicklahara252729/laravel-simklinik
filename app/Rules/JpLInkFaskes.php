<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class JpLinkFaskes implements Rule
{
    protected $table;
    protected $column;
    protected $uuidFaskes;

    public function __construct($table, $column, $uuidFaskes)
    {
        $this->table = $table;
        $this->column = $column;
        $this->uuidFaskes = $uuidFaskes;
    }

    public function passes($attribute, $value)
    {
        $uuidFaskes = authAttribute()['role'] == 'superadmin' ? $this->uuidFaskes : authAttribute()['id_faskes'];
        // Ubah nilai value menjadi array jika belum
        $values = is_array($value) ? $value : [$value];

        // Periksa apakah setiap nilai ada dalam tabel data_blok
        foreach ($values as $jpLinkFaskes) {
            if (!DB::table($this->table)
                ->where($this->column, $jpLinkFaskes)
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
        return 'The selected jenis pembayaran is invalid.';
    }
}
