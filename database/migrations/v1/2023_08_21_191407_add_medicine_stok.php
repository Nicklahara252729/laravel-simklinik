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
        Schema::table('medicine', function (Blueprint $table) {
            $table->bigInteger('stok')->nullable();

        });

        Schema::create('medicine_log', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('id_patient', 50)->nullable();
            $table->string('id_medicine', 50)->nullable();
            $table->bigInteger('total');

            $table->foreign("id_patient")->references("id")->on("patient")->onDelete("set null");
            $table->foreign("id_medicine")->references("id")->on("medicine")->onDelete("set null");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
