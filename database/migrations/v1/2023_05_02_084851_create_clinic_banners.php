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
        Schema::create('clinic_banners', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('id_clinic', 50)->nullable();
            $table->string('path');
            $table->timestamps();

            $table->foreign("id_clinic")->references("id")->on("clinics")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinic_banners');
    }
};