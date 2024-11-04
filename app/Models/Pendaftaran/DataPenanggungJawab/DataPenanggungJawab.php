<?php

namespace App\Models\Pendaftaran\DataPenanggungJawab;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class DataPenanggungJawab extends Model
{
    use HasFactory;

    /**
     * The table name
     */

    protected $table = "data_penanggung_jawab";

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'uuid_data_pj' => 'string',
        'uuid_data_pribadi' => 'string'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($item) {
            $item->uuid_data_pj = Uuid::uuid4()->getHex();
        });
    }
}
