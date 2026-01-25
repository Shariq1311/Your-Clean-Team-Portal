<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnCommentIdOnSticketTicketSupportAttachments extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table(
            'sticket_ticket_support_comments',
            function (Blueprint $table) {
                $table->dropColumn('attachments');
            }
        );

        Schema::table(
            'sticket_ticket_support_attachments',
            function (Blueprint $table) {
                $table->foreignId('comment_id')
                    ->index()
                    ->nullable()
                    ->constrained('sticket_ticket_support_comments');
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
        Schema::table(
            'sticket_ticket_support_attachments',
            function (Blueprint $table) {
                $table->dropForeign(['comment_id']);
                $table->dropColumn('comment_id');
            }
        );

        Schema::table(
            'sticket_ticket_support_comments',
            function (Blueprint $table) {
                $table->json('attachments')->nullable();
            }
        );
    }
};
