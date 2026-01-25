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
        Schema::create('chatbot_configurations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->string('display_name', 100);
            $table->text('description')->nullable();
            $table->json('config')->nullable();
            $table->json('capabilities')->nullable();
            $table->boolean('is_active')->default(false);
            $table->integer('sort_order')->default(0);
            $table->string('status')->default('inactive'); // active, inactive, error
            $table->timestamp('last_tested_at')->nullable();
            $table->text('last_error')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
            
            $table->index(['is_active', 'sort_order']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chatbot_configurations');
    }
}; 