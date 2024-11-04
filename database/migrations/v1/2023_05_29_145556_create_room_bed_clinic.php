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
        Schema::table('room_clinic', function (Blueprint $table) {
            $table->string('class', 50)->nullable();
            $table->dropColumn('amount');
        });

        Schema::create('room_bed_clinic', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('id_room', 50);
            $table->integer('room_number')->nullable();
            $table->timestamps();

            $table->foreign("id_room")->references("id")->on("room_clinic")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_bed_clinic');
    }
};
