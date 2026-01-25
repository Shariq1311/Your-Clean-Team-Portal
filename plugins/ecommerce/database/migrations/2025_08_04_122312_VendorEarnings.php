<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('vendor_earnings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vendor_id')->index();
            $table->unsignedBigInteger('order_id')->index();
            $table->unsignedBigInteger('order_item_id')->index();
            $table->decimal('order_amount', 15, 2);
            $table->decimal('commission_rate', 5, 2);
            $table->decimal('commission_amount', 15, 2);
            $table->decimal('vendor_amount', 15, 2);
            $table->string('currency_code', 10)->default('USD');
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->foreign('vendor_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');

            $table->foreign('order_item_id')
                ->references('id')
                ->on('order_items')
                ->onDelete('cascade');

            $table->unique(['order_item_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_earnings');
    }
};
