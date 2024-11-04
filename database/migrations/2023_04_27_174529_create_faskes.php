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
        Schema::create('faskes', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid_faskes')->unique();
            $table->string('nama', 150);
            $table->char('kode', 50)->unique();
            $table->char('no_faskes', 15)->unique();
            $table->tinyInteger('id_provinsi');
            $table->integer('id_kabupaten');
            $table->integer('id_kecamatan');
            $table->integer('id_desa');
            $table->text('alamat');
            $table->smallInteger('kode_pos');
            $table->string('counter_pasien', 15);
            $table->string('counter_kk', 15);
            $table->string('latitude', 20);
            $table->string('longitude', 20);
            $table->uuid('uuid_user')->comment('kepala puskesmas');
            $table->string('logo', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faskes');
    }
};
