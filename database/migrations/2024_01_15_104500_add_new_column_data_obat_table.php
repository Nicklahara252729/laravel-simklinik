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
        Schema::table('data_obat', function (Blueprint $table) {
            $table->string('pabrikan', 100);
            $table->string('distributor', 100);
            $table->integer('stock');
            $table->integer('modal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_obat');
    }
};
