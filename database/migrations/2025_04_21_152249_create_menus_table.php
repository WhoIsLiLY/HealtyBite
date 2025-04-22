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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurants_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->string('menu_image')->nullable();
            $table->integer('calorie')->nullable();
            $table->text('nutrition_facts')->nullable();
            $table->boolean('isAvailable')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
