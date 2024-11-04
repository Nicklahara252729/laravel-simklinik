<?php

namespace App\Models\MasterData\Poliklinik\Pemeriksaan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Pemeriksaan extends Model
{
   use HasFactory;

   /**
    * The table name
    */

   protected $table = "pemeriksaan";

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
      'uuid_pemeriksaan' => 'string',
   ];

   protected static function boot()
   {
      parent::boot();
      static::creating(function ($item) {
         $item->uuid_pemeriksaan = Uuid::uuid4()->getHex();
      });
   }
}
