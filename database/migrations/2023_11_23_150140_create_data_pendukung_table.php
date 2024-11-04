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
        Schema::create('data_pendukung', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid_data_pendukung')->unique();
            $table->uuid('uuid_data_pribadi');
            $table->date('tgl_kunjungan');
            $table->uuid('uuid_poliklinik_link_klinik')->comment('poliklinik');
            $table->enum('kunjungan',['sehat','sakit']);
            $table->uuid('uuid_tindakan')->comment('tindakan');
            $table->uuid('uuid_jp_link_faskes')->comment('jasa pembayaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pendukung');
    }
};
