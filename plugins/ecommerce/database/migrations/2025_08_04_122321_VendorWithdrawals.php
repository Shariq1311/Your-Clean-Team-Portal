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
        Schema::create('vendor_withdrawals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vendor_id')->index();
            $table->decimal('amount', 15, 2);
            $table->string('currency_code', 10)->default('USD');
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed'])->default('pending');
            $table->string('payment_method', 100)->nullable();
            $table->text('payment_details')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->unsignedBigInteger('processed_by')->nullable();
            $table->timestamps();

            $table->foreign('vendor_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('processed_by')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_withdrawals');
    }
};
