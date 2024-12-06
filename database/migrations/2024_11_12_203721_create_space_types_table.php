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
        Schema::create('space_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('description_ca', 100)->nullable();
            $table->string('description_es', 100)->nullable();
            $table->string('description_en', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('space_types');
    }
};
