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
        Schema::create('jenis_pembayaran_link_faskes', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid_faskes');
            $table->uuid('uuid_jenis_pembayaran');
            $table->uuid('uuid_jp_link_faskes')->unique()->comment('uuid jenis pembayaran link faskes');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_pembayaran_link_faskes');
    }
};
