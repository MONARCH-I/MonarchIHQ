<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Notification preferences
            $table->boolean('notif_orders')->default(true)->after('is_super_admin');
            $table->boolean('notif_promos')->default(false)->after('notif_orders');
            $table->boolean('notif_blog')->default(false)->after('notif_promos');
            $table->boolean('notif_security')->default(true)->after('notif_blog');

            // Display preferences
            $table->string('language')->default('English (Default)')->after('notif_security');
            $table->string('currency')->default('GHS — Ghanaian Cedi')->after('language');

            // Shipping details
            $table->string('address_street')->nullable()->after('currency');
            $table->string('address_city')->nullable()->after('address_street');
            $table->string('address_region')->nullable()->after('address_city');
            $table->string('phone')->nullable()->after('address_region');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'notif_orders', 'notif_promos', 'notif_blog', 'notif_security',
                'language', 'currency',
                'address_street', 'address_city', 'address_region', 'phone',
            ]);
        });
    }
};
