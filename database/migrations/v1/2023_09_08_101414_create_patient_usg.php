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
        Schema::create('patient_usg', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('id_patient', 50);
            $table->string('photo', 50);
            $table->timestamps();

            $table->foreign("id_patient")->references("id")->on("patient")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_usg');
    }
};
