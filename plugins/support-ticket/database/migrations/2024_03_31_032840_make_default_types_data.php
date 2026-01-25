<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class MakeDefaultTypesData extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        $defaults = collect(['Sales', 'Billing', 'Technical Support', 'Other'])->map(
            fn ($item) => ['name' => $item],
        )->toArray();

        DB::table('sticket_ticket_support_types')->insertOrIgnore($defaults);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        //  
    }
};
