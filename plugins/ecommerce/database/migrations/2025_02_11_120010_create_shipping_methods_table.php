<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingMethodsTable extends Migration
{
    public function up()
    {
        Schema::create('shipping_methods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->decimal('cost', 10, 2)->default(0);
            $table->decimal('min_weight', 8, 2)->default(0);
            $table->decimal('max_weight', 8, 2)->default(0);
            $table->decimal('min_order_value', 10, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->string('delivery_time', 255)->nullable();
            $table->json('provinces')->nullable();
            $table->json('countries')->nullable();
            $table->bigInteger('province_id')->nullable()->index();
            $table->string('country_code', 5)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->bigInteger('shop_id')->nullable()->index();
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('shipping_methods');
    }
}
