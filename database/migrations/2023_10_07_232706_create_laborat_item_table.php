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
        Schema::create('laborat_item', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid_laborat');
            $table->uuid('uuid_laborat_item')->unique();
            $table->string('nama_pemeriksaan',50);
            $table->enum('is_active', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laborat_item');
    }
};
