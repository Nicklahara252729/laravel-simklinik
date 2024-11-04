<?php

namespace App\Models\Farmasi\Resep;

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resep extends Model
{
   use HasFactory;

   /**
    * The table name
    */

   protected $table = "resep";

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

   protected $casts = [
      'uuid_resep' => 'string',
   ];

   protected static function boot()
   {
      parent::boot();
      static::creating(function ($item) {
         $item->uuid_resep = Uuid::uuid4()->getHex();
      });
   }
}
