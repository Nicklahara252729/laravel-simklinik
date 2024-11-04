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
        Schema::create('data_penanggung_jawab', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid_data_pj')->unique()->comment('uuid data penanggung jawab');
            $table->uuid('uuid_data_pribadi');
            $table->string('nama_pj', 150)->comment('nama penanggung jawab');
            $table->char('no_hp', 13);
            $table->tinyInteger('id_provinsi');
            $table->integer('id_kabupaten');
            $table->integer('id_kecamatan');
            $table->integer('id_desa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_penanggung_jawab');
    }
};
