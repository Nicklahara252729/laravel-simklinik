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
            $table->string('identity')->nullable()->change();
            $table->string('no_identity')->nullable()->change();
            $table->string('gender')->nullable()->change();
            $table->string('birth_place')->nullable()->change();
            $table->date('birth_date')->nullable()->change();
            $table->string('marital_status')->nullable()->change();
            $table->string('religion')->nullable()->change();
            $table->string('blood')->nullable()->change();
            $table->text('address')->nullable()->change();
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
