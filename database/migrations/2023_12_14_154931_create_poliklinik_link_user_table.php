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
        Schema::create('poliklinik_link_user', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid_poliklinik_link_user')->unique();
            $table->uuid('uuid_user')->comment('perawat');
            $table->uuid('uuid_poliklinik_link_klinik');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poliklinik_link_user');
    }
};
