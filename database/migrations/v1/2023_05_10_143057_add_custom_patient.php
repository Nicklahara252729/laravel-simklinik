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
        Schema::table('patient', function (Blueprint $table) {
            $table->string('created_by', 50)->nullable();
            $table->dateTime('treatment_date');
            $table->string("status");
            $table->string("id_doctor", 50)->nullable();

            $table->foreign("created_by")->references("id")->on("users")->onDelete("set null");
            $table->foreign("id_doctor")->references("id")->on("doctors")->onDelete("set null");
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
