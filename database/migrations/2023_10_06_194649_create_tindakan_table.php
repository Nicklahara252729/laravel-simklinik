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
        Schema::create('tindakan', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid_faskes');
            $table->uuid('uuid_tindakan')->unique();
            $table->text('nama');
            $table->char('kode',20);
            $table->uuid('uuid_tindakan_kategori');
            $table->uuid('uuid_poliklinik_link_klinik');
            $table->integer('harga');
            $table->text('tindakan_harga')->nullable()->comment('format: {uuid_jenis_pembayaran:...,harga_jual:...');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tindakan');
    }
};
