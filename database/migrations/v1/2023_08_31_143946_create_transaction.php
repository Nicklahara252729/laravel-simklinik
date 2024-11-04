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
        Schema::create('transaction', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('id_patient', 50);
            $table->bigInteger('payment');
            $table->bigInteger('change');
            $table->string('created_by', 50);
            $table->timestamps();

            $table->foreign("id_patient")->references("id")->on("patient")->onDelete("cascade");
            $table->foreign("created_by")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction');
    }
};
