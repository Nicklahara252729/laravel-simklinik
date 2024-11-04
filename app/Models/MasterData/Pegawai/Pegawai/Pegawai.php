<?php

namespace App\Models\MasterData\Pegawai\Pegawai;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    /**
     * The table name
     */

     protected $table = "pegawai";

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
         'uuid_user' => 'string'         
     ];     
}
