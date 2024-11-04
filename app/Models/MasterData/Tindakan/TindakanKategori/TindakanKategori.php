<?php

namespace App\Models\MasterData\Tindakan\TindakanKategori;

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TindakanKategori extends Model
{
    use HasFactory;

    /**
     * The table name
     */

    protected $table = "tindakan_kategori";

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
        'uuid_tindakan_kategori' => 'string',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($item) {
            $item->uuid_tindakan_kategori = Uuid::uuid4()->getHex();
        });
    }
}