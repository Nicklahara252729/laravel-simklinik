<?php

namespace App\Models\Region;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Villages extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table     = 'reg_villages';
    public $primaryKey   = 'id';
    protected $keyType   = 'char';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'district_id',
        'name',
    ];
}
