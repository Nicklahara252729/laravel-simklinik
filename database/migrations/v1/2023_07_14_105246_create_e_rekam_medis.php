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
        Schema::create('e_medical_record', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('id_patient', 50)->nullable();
            $table->text('treatment');
            $table->timestamps();

            $table->foreign("id_patient")->references("id")->on("patient")->onDelete("set null");
        });

        Schema::create('e_medical_record_med', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('id_medical_record', 50);
            $table->string('id_medicine', 50)->nullable();
            $table->timestamps();

            $table->foreign("id_medical_record")->references("id")->on("e_medical_record")->onDelete("cascade");
            $table->foreign("id_medicine")->references("id")->on("medicine")->onDelete("set null");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e_rekam_medis');
        Schema::dropIfExists('e_medical_record_med');
    }
};
