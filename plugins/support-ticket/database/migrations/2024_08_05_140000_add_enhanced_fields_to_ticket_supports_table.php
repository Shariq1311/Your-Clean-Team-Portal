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
        Schema::table('sticket_ticket_supports', function (Blueprint $table) {
            // Priority field
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium')->after('status');
            
            // Rating fields
            $table->integer('rating')->nullable()->after('priority');
            $table->text('rating_feedback')->nullable()->after('rating');
            $table->timestamp('rated_at')->nullable()->after('rating_feedback');
            
            // Auto close fields
            $table->timestamp('auto_close_at')->nullable()->after('rated_at');
            $table->timestamp('last_activity_at')->nullable()->after('auto_close_at');
            
            // Escalation fields
            $table->timestamp('escalated_at')->nullable()->after('last_activity_at');
            $table->string('escalated_to')->nullable()->after('escalated_at');
            
            // Assignment fields
            $table->unsignedBigInteger('assigned_to')->nullable()->after('escalated_to');
            $table->timestamp('assigned_at')->nullable()->after('assigned_to');
            
            // Response time tracking
            $table->timestamp('first_response_at')->nullable()->after('assigned_at');
            $table->integer('response_time_minutes')->nullable()->after('first_response_at');
            
            // Customer satisfaction
            $table->integer('customer_satisfaction_score')->nullable()->after('response_time_minutes');
            
            // Tags and categories
            $table->json('tags')->nullable()->after('customer_satisfaction_score');
            $table->string('category')->nullable()->after('tags');
            
            // External references
            $table->string('external_id')->nullable()->after('category');
            $table->string('source')->default('web')->after('external_id');
            
            // SLA tracking
            $table->timestamp('sla_deadline')->nullable()->after('source');
            $table->boolean('sla_breached')->default(false)->after('sla_deadline');
            
            // Add indexes for better performance
            $table->index(['status', 'priority']);
            $table->index(['assigned_to']);
            $table->index(['created_at']);
            $table->index(['last_activity_at']);
            $table->index(['auto_close_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sticket_ticket_supports', function (Blueprint $table) {
            // Drop indexes
            $table->dropIndex(['status', 'priority']);
            $table->dropIndex(['assigned_to']);
            $table->dropIndex(['created_at']);
            $table->dropIndex(['last_activity_at']);
            $table->dropIndex(['auto_close_at']);
            
            // Drop columns
            $table->dropColumn([
                'priority',
                'rating',
                'rating_feedback',
                'rated_at',
                'auto_close_at',
                'last_activity_at',
                'escalated_at',
                'escalated_to',
                'assigned_to',
                'assigned_at',
                'first_response_at',
                'response_time_minutes',
                'customer_satisfaction_score',
                'tags',
                'category',
                'external_id',
                'source',
                'sla_deadline',
                'sla_breached',
            ]);
        });
    }
}; 