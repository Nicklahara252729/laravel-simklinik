<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class Diagnosa implements Rule
{

    public function __construct()
    {
    }

    public function passes($attribute, $value)
    {
        $values = is_array($value) ? $value : [$value];
        foreach ($values as $code) {
            if (!DB::table('icd10')
                ->where('code', $code)
                ->exists()) {
                return false;
            }
        }

        return true;
    }

    public function message()
    {
        return 'The selected diagnosa is invalid.';
    }
}
