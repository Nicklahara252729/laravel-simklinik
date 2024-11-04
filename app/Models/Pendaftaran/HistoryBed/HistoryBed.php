<?php

namespace App\Models\Pendaftaran\HistoryBed;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryBed extends Model
{
   use HasFactory;

   /**
    * The table name
    */

   protected $table = "history_bed";

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
      'uuid_history_bed' => 'string',
      'uuid_data_pribadi' => 'string',
   ];

   protected static function boot()
   {
      parent::boot();
      static::creating(function ($item) {
         $item->uuid_history_bed = Uuid::uuid4()->getHex();
      });
   }
}
