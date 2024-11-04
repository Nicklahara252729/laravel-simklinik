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
        Schema::create('tindakan_kategori', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid_faskes');
            $table->uuid('uuid_tindakan_kategori')->unique();
            $table->string('kategori',50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tindakan_kategori');
    }
};