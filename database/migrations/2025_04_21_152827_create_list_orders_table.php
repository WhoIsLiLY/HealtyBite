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
        Schema::create('list_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orders_id')->constrained()->onDelete('cascade');
            $table->foreignId('menus_id')->constrained('menus')->onDelete('cascade');
            $table->text('detail');
            $table->integer('quantity');
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_orders');
    }
};
