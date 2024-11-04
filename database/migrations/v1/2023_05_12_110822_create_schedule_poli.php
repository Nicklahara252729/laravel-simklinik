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
        Schema::create('schedule_poli', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('id_poli', 50);
            $table->string('day');
            $table->time('from');
            $table->time('until');
            $table->timestamps();

            $table->foreign("id_poli")->references("id")->on("poli")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_poli');
    }
};
