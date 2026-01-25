<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketSupportCommentsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'sticket_ticket_support_comments',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->text('content');
                $table->json('attachments')->nullable();
                $table->foreignUuid('ticket_support_id')->index()->constrained('sticket_ticket_supports');
                $table->foreignId('created_by')
                    ->index()
                    ->nullable()
                    ->constrained('users')
                    ->onDelete('set null');
                $table->timestamps();
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
        Schema::dropIfExists('sticket_ticket_support_comments');
    }
};
