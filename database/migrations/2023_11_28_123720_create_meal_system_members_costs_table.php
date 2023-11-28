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
        Schema::create('meal_system_members_costs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meal_system_member_id')->constrained('meal_system_members')->onDelete('cascade');
            $table->string('balance');
            $table->string('due');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_system_members_costs');
    }
};
