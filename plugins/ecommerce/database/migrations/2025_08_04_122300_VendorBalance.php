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
        Schema::create('vendor_balances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vendor_id')->index();
            $table->decimal('balance', 15, 2)->default(0);
            $table->decimal('total_earnings', 15, 2)->default(0);
            $table->decimal('total_withdrawals', 15, 2)->default(0);
            $table->decimal('pending_balance', 15, 2)->default(0);
            $table->string('currency_code', 10)->default('USD');
            $table->timestamps();

            $table->foreign('vendor_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->unique(['vendor_id', 'currency_code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_balances');
    }
};
