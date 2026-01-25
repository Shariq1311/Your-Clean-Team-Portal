<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('pos_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('session_name')->nullable();
            $table->decimal('opening_balance', 15, 2)->default(0);
            $table->decimal('closing_balance', 15, 2)->nullable();
            $table->decimal('expected_balance', 15, 2)->nullable();
            $table->decimal('total_cash_sales', 15, 2)->default(0);
            $table->decimal('total_card_sales', 15, 2)->default(0);
            $table->decimal('total_digital_sales', 15, 2)->default(0);
            $table->integer('total_transactions')->default(0);
            $table->enum('status', ['active', 'closed'])->default('active');
            $table->timestamp('opened_at');
            $table->timestamp('closed_at')->nullable();
            $table->json('session_data')->nullable(); // Store additional session info
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['user_id', 'status']);
            $table->index('opened_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('pos_sessions');
    }
} 