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
        Schema::table('patient_data', function (Blueprint $table) {
            $table->string('ktp')->nullable()->after("address");
            $table->string('kk')->nullable()->after("address");
            $table->string('bpjs')->nullable()->after("address");
            $table->string('other_file')->nullable()->after("address");
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
