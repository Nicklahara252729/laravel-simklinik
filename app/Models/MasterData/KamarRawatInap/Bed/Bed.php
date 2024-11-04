<?php

namespace App\Models\MasterData\KamarRawatInap\Bed;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Bed extends Model
{
    use HasFactory;

    /**
     * The table name
     */

    protected $table = "bed";

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
        'uuid_kamar' => 'string',
        'uuid_bed' => 'string',
        'uuid_user' => 'string'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($item) {
            $item->uuid_bed = Uuid::uuid4()->getHex();
        });
    }
}
