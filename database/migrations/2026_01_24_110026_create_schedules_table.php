<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->date('scheduled_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->bigInteger('location_id')->unsigned()->nullable();
            $table->bigInteger('service_id')->unsigned()->nullable();
            $table->string('status')->default('scheduled');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_schedules');
    }
};
