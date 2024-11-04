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
        Schema::create('resep', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid_resep')->unique();
            $table->uuid('uuid_pemeriksaan');
            $table->uuid('uuid_data_obat');
            $table->text('aturan_pakai');
            $table->integer('jumlah');
            $table->integer('harga');
            $table->string('batch_no', 50);
            $table->date('expired');
            $table->integer('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resep');
    }
};
