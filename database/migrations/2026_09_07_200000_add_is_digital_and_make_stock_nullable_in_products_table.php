<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_digital')->default(false)->after('sale_price');
            $table->integer('stock_quantity')->nullable()->default(null)->change();
            $table->integer('min_stock_threshold')->nullable()->default(null)->change();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('is_digital');
            $table->integer('stock_quantity')->default(0)->change();
            $table->integer('min_stock_threshold')->default(5)->change();
        });
    }
};
