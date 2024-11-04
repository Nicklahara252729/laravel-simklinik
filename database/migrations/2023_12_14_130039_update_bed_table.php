<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBedTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bed', function (Blueprint $table) {
            $table->renameColumn('uuid_user','status');
         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bed', function (Blueprint $table) {
            $table->renameColumn('status','uuid_user');
      });
    }
};
