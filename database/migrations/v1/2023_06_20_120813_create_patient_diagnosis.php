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
        Schema::create('patient_diagnosis', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('id_patient', 50);
            $table->string('id_medicine', 50)->nullable();
            $table->integer('price');
            $table->text('note');
            $table->timestamps();

            $table->foreign("id_patient")->references("id")->on("patient")->onDelete("cascade");
            $table->foreign("id_medicine")->references("id")->on("medicine")->onDelete("set null");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_diagnosis');
    }
};
