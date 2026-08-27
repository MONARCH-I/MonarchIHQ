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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_status')->default('pending')->after('status'); // pending | paid | failed | refunded
            $table->string('payment_method')->default('paystack')->after('payment_status');
            $table->string('payment_reference')->nullable()->unique()->after('payment_method');
            $table->string('payment_channel')->nullable()->after('payment_reference'); // mobile_money | card | etc.
            $table->timestamp('paid_at')->nullable()->after('payment_channel');
            $table->json('paystack_response')->nullable()->after('paid_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'payment_status',
                'payment_method',
                'payment_reference',
                'payment_channel',
                'paid_at',
                'paystack_response',
            ]);
        });
    }
};
