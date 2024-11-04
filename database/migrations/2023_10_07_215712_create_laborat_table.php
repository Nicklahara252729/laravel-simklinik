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
        Schema::create('laborat', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid_faskes');
            $table->uuid('uuid_laborat')->unique();
            $table->string('nama',100);
            $table->string('kode',15);
            $table->uuid('uuid_laborat_kategori');
            $table->integer('harga');
            $table->text('laborat_harga')->nullable()->comment('format: {uuid_jenis_pembayaran:...,harga_jual:...');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laborat');
    }
};
