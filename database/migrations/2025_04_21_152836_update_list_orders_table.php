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
        Schema::table('list_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('addons_id')->nullable()->after('menus_id');
            $table->foreign('addons_id')->references('id')->on('addons')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('list_orders', function (Blueprint $table) {
            $table->dropForeign(['addons_id']);
            $table->dropColumn('addons_id');
        });
    }
};
