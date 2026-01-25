<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewslettersSubscribersTable extends Migration
{
    /**
     * Run the migrations. 
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'newsletters_subscribers',
            function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('email')->index()->unique();
                $table->boolean('is_subscribed')->default(true)->nullable();
                $table->json('metas')->nullable();
                $table->unsignedBigInteger('site_id')->default(0)->index();
                $table->timestamps();
                $table->index(['created_at']);
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
        Schema::dropIfExists('newsletters_subscribers');
    }
};
