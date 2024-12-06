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
        Schema::create('spaces', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('regNumber', 10)->unique();
            $table->string('observation_ca', 5000)->nullable();
            $table->string('observation_es', 5000)->nullable();
            $table->string('observation_en', 5000)->nullable();
            $table->string('email', 100);
            $table->string('phone', 100);
            $table->string('website', 100);
            $table->string('accesType', 1);
            $table->integer('totalScore');
            $table->integer('countScore');
            $table->foreignId('address_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('space_type_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spaces');
    }
};
