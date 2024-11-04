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
        Schema::create('clinics', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('clinic_name')->unique();
            $table->string('logo')->nullable();
            $table->boolean('active')->default(true);
            $table->string('registered_by');
            $table->mediumInteger('licence_duration');
            $table->string('phone', 13)->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinics');
    }
};
