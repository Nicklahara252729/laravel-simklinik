<?php

namespace App\Models\MasterData\Poliklinik\PoliklinikLinkKlinik;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class PoliklinikLinkKlinik extends Model
{
    use HasFactory;

    /**
     * The table name
     */

    protected $table = "poliklinik_link_klinik";

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
        'uuid_faskes' => 'string',
        'uuid_poliklinik' => 'string',
        'uuid_poliklinik_link_klinik' => 'string',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($item) {
            $item->uuid_poliklinik_link_klinik = Uuid::uuid4()->getHex();
        });
    }
}