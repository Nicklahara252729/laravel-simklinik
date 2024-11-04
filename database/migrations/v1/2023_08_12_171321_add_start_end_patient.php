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
            $table->date('treatment_date')->nullable()->change();
            $table->string('id_schedule_poli', 50)->nullable()->after('treatment_date');

            $table->foreign("id_schedule_poli")->references("id")->on("schedule_poli")->onDelete("set null");
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
