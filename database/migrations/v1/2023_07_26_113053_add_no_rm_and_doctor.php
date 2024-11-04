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
            $table->string('no_rm')->unique()->after('id_poli')->nullable();
        });

        Schema::table('e_medical_record', function (Blueprint $table) {
            $table->string('id_doctor', 50)->after('id_patient')->nullable();

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
