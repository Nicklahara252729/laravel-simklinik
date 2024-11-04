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
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid_pendaftaran')->unique();
            $table->uuid('uuid_faskes');
            $table->uuid('uuid_data_pribadi');
            $table->string('no_pendaftaran',30);
            $table->enum('jenis_layanan',['igd','rawat jalan','rawat inap']);
            $table->enum('jenis_pelayanan',['umum','bpjs','lainnya']);
            $table->tinyInteger('status')->default(0)->comment('0 = prosese, 1 = selesai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
