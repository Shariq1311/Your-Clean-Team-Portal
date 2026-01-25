<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('pos_order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pos_order_id');
            $table->unsignedBigInteger('post_id'); // Product/Service ID
            $table->string('product_name');
            $table->string('product_sku')->nullable();
            $table->decimal('product_price', 15, 2);
            $table->integer('quantity');
            $table->decimal('subtotal', 15, 2); // price * quantity
            $table->decimal('discount_amount', 15, 2)->default(0);
            $table->decimal('tax_amount', 15, 2)->default(0);
            $table->decimal('total_amount', 15, 2); // subtotal - discount + tax
            $table->json('product_data')->nullable(); // Store product snapshot
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('pos_order_id')->references('id')->on('pos_orders')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->index(['pos_order_id']);
            $table->index(['post_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('pos_order_items');
    }
} 