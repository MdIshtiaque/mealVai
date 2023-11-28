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
        Schema::create('meal_system_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meal_system_id')->constrained('meal_systems')->onDelete('cascade');
            $table->integer('no_of_members');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_system_infos');
    }
};
