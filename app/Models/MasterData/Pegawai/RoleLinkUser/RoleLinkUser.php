<?php

namespace App\Models\MasterData\Pegawai\RoleLinkUser;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class RoleLinkUser extends Model
{
    use HasFactory;

    /**
     * The table name
     */

    protected $table = "role_link_user";

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
        'uuid_user' => 'string',
        'uuid_role_link_user' => 'string'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($item) {
            $item->uuid_role_link_user = Uuid::uuid4()->getHex();
        });
    }
}
