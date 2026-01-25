<?php
// phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'ecomm_discounts',
            function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('code')->unique()->index();
                $table->text('description')->nullable();
                $table->enum('type', ['percentage', 'fixed'])->default('percentage');
                $table->decimal('value', 10, 2);
                $table->decimal('minimum_amount', 10, 2)->default(0);
                $table->decimal('maximum_discount', 10, 2)->nullable();
                $table->integer('usage_limit')->nullable();
                $table->integer('usage_limit_per_customer')->nullable();
                $table->integer('used_count')->default(0);
                $table->boolean('is_active')->default(true);
                $table->boolean('free_shipping')->default(false);
                $table->date('start_date')->nullable();
                $table->date('end_date')->nullable();
                $table->json('applicable_products')->nullable();
                $table->json('applicable_categories')->nullable();
                $table->json('excluded_products')->nullable();
                $table->json('excluded_categories')->nullable();
                $table->unsignedBigInteger('site_id')->default(0)->index();
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ecomm_discounts');
    }
};
