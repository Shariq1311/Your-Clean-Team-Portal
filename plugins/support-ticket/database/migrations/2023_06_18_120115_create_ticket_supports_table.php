<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketSupportsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'sticket_ticket_supports',
            function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->foreignId('support_type_id')->constrained('sticket_ticket_support_types');
                $table->string('title', 250);
                $table->text('content')->nullable();
                $table->json('attachments')->nullable();
                $table->string('status', 10)->default('pending')->index();
                $table->foreignId('product_id')
                    ->index()
                    ->nullable()
                    ->constrained('posts')
                    ->onDelete('cascade');
                $table->foreignId('created_by')
                    ->index()
                    ->nullable()
                    ->constrained('users')
                    ->onDelete('set null');
                $table->timestamps();
                $table->index(['created_at', 'updated_at']);
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('sticket_ticket_supports');
    }
};
