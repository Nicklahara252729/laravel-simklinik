<?php

namespace App\Models\MasterData\JenisPembayaran\JenisPembayaranLinkFaskes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class JenisPembayaranLinkFaskes extends Model
{
    use HasFactory;

    /**
     * The table name
     */

    protected $table = "jenis_pembayaran_link_faskes";

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
        'uuid_jenis_pembayaran' => 'string',
        'uuid_jp_link_faskes' => 'string',
    ];
}
