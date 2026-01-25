<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('pos_carts', function (Blueprint $table) {
            $table->id();
            $table->string('cart_token', 100)->unique();
            $table->unsignedBigInteger('user_id'); // Cashier/Admin
            $table->unsignedBigInteger('pos_session_id')->nullable();
            $table->string('customer_name')->default('Walk-in Customer');
            $table->string('customer_phone')->nullable();
            $table->string('customer_email')->nullable();
            $table->json('items')->nullable(); // Cart items as JSON
            $table->json('discounts')->nullable(); // Applied discounts
            $table->decimal('subtotal', 15, 2)->default(0);
            $table->decimal('tax_amount', 15, 2)->default(0);
            $table->decimal('discount_amount', 15, 2)->default(0);
            $table->decimal('total_amount', 15, 2)->default(0);
            $table->enum('status', ['active', 'converted', 'abandoned'])->default('active');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('pos_session_id')->references('id')->on('pos_sessions')->onDelete('set null');
            $table->index(['user_id', 'status']);
            $table->index(['cart_token']);
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
        Schema::dropIfExists('pos_carts');
    }
} 