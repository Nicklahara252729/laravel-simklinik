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
        Schema::create('data_obat', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid_faskes');
            $table->uuid('uuid_data_obat')->unique();
            $table->string('kode', 20)->unique();
            $table->string('nama', 150);
            $table->uuid('uuid_satuan_obat');
            $table->uuid('uuid_klasifikasi_obat');
            $table->enum('jenis', ['bhp', 'obat injeksi', 'reagent', 'vaksin', 'imunisasi']);
            $table->integer('harga_satuan');
            $table->date('tgl_expired');
            $table->string('no_batch', 25)->nullable();
            $table->integer('harga_beli');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->text('harga_obat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_obat');
    }
};
