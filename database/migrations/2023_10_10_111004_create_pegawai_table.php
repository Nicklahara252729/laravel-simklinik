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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid_user')->unique();
            $table->char('no_ktp',16)->unique()->nullable();
            $table->char('no_npwp',16)->nullable()->unique();
            $table->char('no_str',16)->nullable()->unique();
            $table->date('tgl_berlaku_str')->nullable();
            $table->date('tgl_berakhir_str')->nullable();
            $table->string('no_sip',50)->nullable()->unique();
            $table->date('tgl_berlaku_sip')->nullable();
            $table->date('tgl_berakhir_sip')->nullable();
            $table->uuid('uuid_spesialis')->nullable()->comment('khusus dokter');
            $table->text('alamat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
