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
        Schema::create('schedule_doctors', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('id_clinic', 50)->nullable();
            $table->string('id_doctor', 50);
            $table->string('day');
            $table->time('from');
            $table->time('until');
            $table->timestamps();

            $table->foreign("id_clinic")->references("id")->on("clinics")->onDelete("cascade");
            $table->foreign("id_doctor")->references("id")->on("doctors")->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_doctors');
    }
};
