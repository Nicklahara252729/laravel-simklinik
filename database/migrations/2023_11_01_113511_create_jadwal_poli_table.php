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
        Schema::create('jadwal_poli', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid_faskes');
            $table->uuid('uuid_poliklinik');
            $table->uuid('uuid_jadwal_poli')->unique();
            $table->uuid('dokter')->comment('uuid user as dokter');
            $table->uuid('perawat')->comment('uuid user as perawat');
            $table->enum('hari', ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu']);
            $table->string('jam', 15);
            $table->text('keterangan')->nullable()->comment('keterangan tambahan');
            $table->string('kode_antrian', 5)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_poli');
    }
};
