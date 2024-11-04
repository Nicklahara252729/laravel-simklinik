<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Helpers\CheckerHelpers;

class PoliklinikLinkKlinik implements Rule
{
    protected $uuidFaskes;
    protected $uuid_role;

    public function __construct(
        $uuidFaskes,
        $uuid_role
    ) {
        $this->uuidFaskes = $uuidFaskes;
        $this->uuid_role = $uuid_role;
    }

    public function passes($attribute, $value)
    {
        /**
         * get role name
         */
        $checkerHelper = new CheckerHelpers;
        $getRole = $checkerHelper->roleChecker(['uuid_role' => $this->uuid_role]);
        if (is_null($getRole)) :
            return false;
        endif;

        /**
         * check each value
         */
        if ($getRole->menu == 'Poliklinik') :
            $uuidFaskes = authAttribute()['role'] == 'superadmin' ? $this->uuidFaskes : authAttribute()['id_faskes'];
            // Ubah nilai value menjadi array jika belum
            $values = is_array($value) ? $value : [$value];

            // Periksa apakah setiap nilai ada dalam tabel poliklinik link klinik
            foreach ($values as $uuidPoliklinikLinkKlinik) :
                if (!DB::table('poliklinik_link_klinik')
                    ->where('uuid_poliklinik_link_klinik', $uuidPoliklinikLinkKlinik)
                    ->where([
                        'uuid_faskes' => $uuidFaskes,
                    ])
                    ->exists()) {
                    return false;
                }
            endforeach;
        endif;



        return true;
    }

    public function message()
    {
        return 'uuid poliklinik link klinik tidak valid';
    }
}
