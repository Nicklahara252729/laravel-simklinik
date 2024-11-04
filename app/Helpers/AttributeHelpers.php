<?php

/**
 * import component
 */

use Illuminate\Support\Facades\Auth;

/**
 * import helper
 */

use App\Helpers\CheckerHelpers;

/**
 * global atribute
 */
function globalAttribute()
{
    return [
        'uriSegment1' => request()->segment(1),
        'uriSegment2' => request()->segment(2),
        'uriSegment3' => request()->segment(3),
        'uriSegment4' => request()->segment(4),
        'uriSegment5' => request()->segment(5),
    ];
}

/**
 * auth attribute
 */
function authAttribute()
{
    return [
        'id' => Auth::user()->uuid_user,
        'id_faskes' => Auth::user()->uuid_faskes,
        'role' => Auth::user()->level,
    ];
}

/**
 * breadctrumb attribute
 */
function breadcrumbAttribute()
{
    return [];
}

/**
 * images path
 */
function path($type)
{
    $key  = "type";
    $data = [
        [
            'type' => 'user',
            'path' => 'assets/images/avatars'
        ],
        [
            'type' => 'faskes',
            'path' => 'assets/images/faskes'
        ],
        [
            'type' => 'pasien',
            'path' => 'assets/images/pasien'
        ],
    ];

    $filteredArray = array_filter($data, function ($item) use ($key, $type) {
        return $item[$key] === $type;
    });

    return array_values($filteredArray)[0]['path'];
}

/**
 * days
 */
function daysAttribute()
{
    return ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
}


/**
 * level validation
 */
function levelValidationAttribute($param)
{
    $level = ['superadmin', 'admin_dinas', 'admin_faskes', 'operator', 'dokter', 'staff', 'pasien','resepsionis','apoteker','kasir','perawat','poli'];
    return in_array($param, $level) ? true : false;
}
