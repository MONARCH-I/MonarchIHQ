<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mai_conversations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title')->default('New Conversation'); // auto-generated from first message
            $table->timestamps();
        });

        Schema::create('mai_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')->constrained('mai_conversations')->cascadeOnDelete();
            $table->enum('role', ['user', 'assistant']);
            $table->text('content');                  // the message text (markdown for assistant)
            $table->text('reasoning')->nullable();    // Gemini's step-by-step reasoning
            $table->text('sql')->nullable();          // generated SQL query
            $table->integer('results_count')->nullable();
            $table->json('results_preview')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mai_messages');
        Schema::dropIfExists('mai_conversations');
    }
};
