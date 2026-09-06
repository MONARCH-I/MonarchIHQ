<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_listing_id')->constrained('job_listings')->cascadeOnDelete();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('portfolio_url', 500)->nullable();
            $table->string('linkedin_url', 500)->nullable();
            $table->text('cover_letter')->nullable();
            $table->string('resume_path', 500);
            $table->string('resume_filename');
            $table->string('status')->default('pending'); // pending, reviewed, shortlisted, rejected
            $table->text('hr_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
