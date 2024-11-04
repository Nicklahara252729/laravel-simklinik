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
        Schema::create('patient_responsible', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('name');
            $table->string('gender');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('identity');
            $table->string('no_identity');
            $table->string('phone');
            $table->text('address');
            $table->timestamps();
        });

        Schema::table('patient', function (Blueprint $table) {
            $table->string('id_patient_responsible', 50)->nullable();

            $table->foreign("id_patient_responsible")->references("id")->on("patient_responsible")->onDelete("set null");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_responsible');
    }
};
