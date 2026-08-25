<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique()->nullable();
            $table->text('description')->nullable();
            $table->string('short_description')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->integer('stock_quantity')->default(0);
            $table->integer('min_stock_threshold')->default(5);
            $table->boolean('is_featured')->default(false); // shows in "New Products" carousel
            $table->boolean('is_active')->default(true);
            $table->string('badge_text')->nullable(); // e.g. "New", "Pre-Order", "Limited Time"
            $table->string('badge_color')->default('orange'); // orange | red | green | blue
            $table->string('card_style')->default('light'); // dark | light | promo (for featured cards)
            $table->string('image_path')->nullable();
            $table->json('gallery')->nullable(); // array of additional image paths
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
