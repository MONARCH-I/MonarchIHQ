<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('badge_color')->nullable()->default('orange')->change();
            $table->string('card_style')->nullable()->default('light')->change();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('badge_color')->default('orange')->change();
            $table->string('card_style')->default('light')->change();
        });
    }
};
