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
        Schema::create('reference_doctor', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('instansi_perujuk')->nullable();
            $table->string('nama_perujuk')->nullable();
            $table->text('alasan_datang')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });

        Schema::table('patient', function (Blueprint $table) {
            $table->string('id_reference_doctor', 50)->nullable();

            $table->foreign("id_reference_doctor")->references("id")->on("reference_doctor")->onDelete("set null");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reference_doctor');
    }
};
