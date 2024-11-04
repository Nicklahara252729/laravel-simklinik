<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('data_pribadi', function (Blueprint $table) {
            $table->string('no_rm',30)->nullable()->comment('nomor rekam medis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_pribadi', function (Blueprint $table) {
            //
        });
    }
};
