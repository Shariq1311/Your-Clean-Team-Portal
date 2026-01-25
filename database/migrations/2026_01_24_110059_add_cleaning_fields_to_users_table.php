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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->string('employee_id')->nullable()->unique()->after('phone');
            $table->string('address')->nullable()->after('employee_id');
            $table->string('city')->nullable()->after('address');
            $table->string('state')->nullable()->after('city');
            $table->string('zip_code')->nullable()->after('state');
            $table->decimal('hourly_rate', 10, 2)->nullable()->after('zip_code');
            $table->string('employment_type')->default('full-time')->after('hourly_rate');
            $table->date('hire_date')->nullable()->after('employment_type');
            $table->boolean('is_active')->default(true)->after('hire_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'employee_id',
                'address',
                'city',
                'state',
                'zip_code',
                'hourly_rate',
                'employment_type',
                'hire_date',
                'is_active'
            ]);
        });
    }
};
