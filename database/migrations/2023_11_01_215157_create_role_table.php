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
        Schema::create('role', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid_role')->unique();
            $table->string('menu', 20);
            $table->string('link', 50);
            $table->string('icon', 30)->nullable();
            $table->uuid('parent')->nullable();
            $table->tinyInteger('superadmin')->default(1);
            $table->tinyInteger('admin_dinas')->default(1);
            $table->tinyInteger('admin_faskes')->default(1);
            $table->tinyInteger('operator')->default(1);
            $table->tinyInteger('dokter')->default(1);
            $table->tinyInteger('staff')->default(1);
            $table->tinyInteger('pasien')->default(1);
            $table->tinyInteger('resepsionis')->default(1);
            $table->tinyInteger('apoteker')->default(1);
            $table->tinyInteger('kasir')->default(1);
            $table->tinyInteger('perawat')->default(1);
            $table->tinyInteger('poli')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role');
    }
};
