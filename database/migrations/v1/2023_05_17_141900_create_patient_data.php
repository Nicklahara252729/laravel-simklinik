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
            $table->string('register_at');
        });

        Schema::create('patient_data', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('id_user', 50);
            $table->string('identity');
            $table->string('no_identity');
            $table->string('gender');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('marital_status');
            $table->string('religion');
            $table->string('blood');
            $table->string('id_province')->nullable();
            $table->string('id_district')->nullable();
            $table->string('id_sub_district')->nullable();
            $table->string('work')->nullable();
            $table->string('company')->nullable();
            $table->string('mother_name')->nullable();
            $table->text('address');
            $table->timestamps();

            $table->foreign("id_user")->references("id")->on("users")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_data');
    }
};
