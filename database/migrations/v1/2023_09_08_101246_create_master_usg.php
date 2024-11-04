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
        Schema::create('master_usg', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('name');
            $table->bigInteger('price');
            $table->timestamps();
        });

        Schema::table('patient', function (Blueprint $table) {
            $table->string('id_master_usg', 50)->nullable();

            $table->foreign("id_master_usg")->references("id")->on("master_usg");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_usg');
    }
};
