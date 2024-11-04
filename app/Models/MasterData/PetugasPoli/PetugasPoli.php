<?php

namespace App\Models\MasterData\PetugasPoli;

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PetugasPoli extends Model
{
    use HasFactory;

    /**
     * The table name
     */

    protected $table = "petugas_poli";

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
        'uuid_user'             => 'string',
        'uuid_petugas_poli'     => 'string',
        'uuid_faskes' => 'string',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($item) {
            $item->uuid_petugas_poli = Uuid::uuid4()->getHex();
        });
    }
}