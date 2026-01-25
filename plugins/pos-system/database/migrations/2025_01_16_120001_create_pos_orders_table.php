<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('pos_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number', 50)->unique();
            $table->unsignedBigInteger('user_id'); // Cashier/Admin
            $table->unsignedBigInteger('pos_session_id')->nullable();
            $table->string('customer_name')->default('Walk-in Customer');
            $table->string('customer_phone')->nullable();
            $table->string('customer_email')->nullable();
            $table->decimal('subtotal', 15, 2);
            $table->decimal('tax_amount', 15, 2)->default(0);
            $table->decimal('discount_amount', 15, 2)->default(0);
            $table->decimal('total_amount', 15, 2);
            $table->decimal('paid_amount', 15, 2)->default(0);
            $table->decimal('change_amount', 15, 2)->default(0);
            $table->enum('payment_method', ['cash', 'card', 'digital'])->default('cash');
            $table->enum('status', ['pending', 'completed', 'hold', 'cancelled', 'refunded'])->default('pending');
            $table->text('notes')->nullable();
            $table->json('order_data')->nullable(); // Store additional order info
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('pos_session_id')->references('id')->on('pos_sessions')->onDelete('set null');
            $table->index(['user_id', 'status']);
            $table->index(['pos_session_id', 'status']);
            $table->index('order_number');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('pos_orders');
    }
} 