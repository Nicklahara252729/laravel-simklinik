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
        Schema::create('doctors', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('id_user', 50);
            $table->string('id_specialist');
            $table->string('nip');
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign("id_user")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("id_specialist")->references("id")->on("specialist_doctor")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
