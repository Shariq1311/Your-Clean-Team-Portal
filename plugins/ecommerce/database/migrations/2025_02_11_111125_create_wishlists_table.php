<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWishlistsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'ecomm_wishlists',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->uuid('code');
                $table->json('items')->nullable();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->unsignedBigInteger('site_id')->default(0)->index();
                $table->timestamps();
                
                $table->unique(['code', 'site_id']);
    
                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('ecomm_wishlists');
    }
} 