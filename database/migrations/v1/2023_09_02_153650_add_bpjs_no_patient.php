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
            $table->string("no_patient")->after('id_user')->unique();
            $table->string("no_bpjs")->after('bpjs')->nullable();
        });

        Schema::table('patient', function (Blueprint $table) {
            $table->boolean('status_bpjs')->default(false);
        });

        Schema::table('clinics', function (Blueprint $table) {
            $table->bigInteger("admin_fee")->default(0);
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
