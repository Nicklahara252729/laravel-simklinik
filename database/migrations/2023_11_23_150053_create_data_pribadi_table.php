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
        Schema::create('data_pribadi', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid_data_pribadi')->unique();
            $table->uuid('uuid_faskes');
            $table->char('no_ktp', 16);
            $table->string('nama_pasien', 150);
            $table->date('tgl_lahir');
            $table->text('alamat');
            $table->string('email');
            $table->enum('gender', ['laki - laki', 'perempuan']);
            $table->enum('golongan_darah',['a','b','o','ab']);
            $table->char('no_hp_1',13);
            $table->char('no_hp_2',13)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pribadi');
    }
};
