<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolio_projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            // JSON array of tech stack strings e.g. ["Laravel 12","WebSockets","HL7/FHIR"]
            $table->json('tech_stack')->nullable();
            $table->string('domain');        // e.g. "Enterprise AI"
            $table->string('sub_domain')->nullable(); // e.g. "Healthcare"
            // status: deployed | active_iot | high_availability | production | in_development
            $table->string('status')->default('in_development');
            $table->string('status_color')->default('blue'); // blue | green | amber | purple
            $table->string('metric_label')->nullable();  // e.g. "Scale"
            $table->string('metric_value')->nullable();  // e.g. "10M+ daily events"
            $table->boolean('is_published')->default(false);
            $table->integer('sort_order')->default(0);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolio_projects');
    }
};
