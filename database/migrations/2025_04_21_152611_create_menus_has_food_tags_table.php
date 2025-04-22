<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menus_has_food_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menus_id')->constrained('menus')->onDelete('cascade');
            $table->foreignId('food_tags_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus_has_food_tags');
    }
};
