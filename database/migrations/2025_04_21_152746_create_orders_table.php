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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customers_id')->constrained()->onDelete('cascade');
            $table->foreignId('restaurants_id')->constrained()->onDelete('cascade');
            $table->foreignId('payment_methods_id')->constrained()->onDelete('cascade');
            $table->decimal('total_price', 10, 2);
            $table->enum('order_type', ['dine-in', 'take-away']);
            $table->enum('status', ['preparing', 'delivering', 'ready', 'completed', 'cancelled'])->default('preparing');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
