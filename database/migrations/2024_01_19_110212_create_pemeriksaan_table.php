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
        Schema::create('pemeriksaan', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid_pemeriksaan')->unique();
            $table->uuid('uuid_pendaftaran')->unique();
            $table->uuid('uuid_data_pribadi');
            $table->text('tindakan_perawat')->nullable()->comment('format: [{uuid_tindakan:...,nama:...,harga:...');
            $table->text('tindakan_dokter')->nullable()->comment('format: [{uuid_tindakan:...,nama:...,harga:...');
            $table->text('diagnosa')->nullable()->comment('format: [{code:...');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan');
    }
};
