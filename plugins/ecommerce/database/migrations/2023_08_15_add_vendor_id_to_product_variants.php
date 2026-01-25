<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_variants', function (Blueprint $table) {
            if (!Schema::hasColumn('product_variants', 'vendor_id')) {
                $table->unsignedBigInteger('vendor_id')->nullable()->after('post_id');
                
                $table->foreign('vendor_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_variants', function (Blueprint $table) {
            if (Schema::hasColumn('product_variants', 'vendor_id')) {
                $table->dropForeign(['vendor_id']);
                $table->dropColumn('vendor_id');
            }
        });
    }
};