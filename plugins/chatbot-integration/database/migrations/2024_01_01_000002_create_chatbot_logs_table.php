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
        Schema::create('chatbot_logs', function (Blueprint $table) {
            $table->id();
            $table->string('provider', 50);
            $table->string('event_type', 100); // webhook, message, error, connection_test, etc.
            $table->string('level', 20)->default('info'); // debug, info, warning, error
            $table->text('message');
            $table->json('payload')->nullable();
            $table->json('context')->nullable();
            $table->string('user_id')->nullable();
            $table->string('session_id')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
            
            $table->index(['provider', 'event_type']);
            $table->index(['level', 'created_at']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chatbot_logs');
    }
};