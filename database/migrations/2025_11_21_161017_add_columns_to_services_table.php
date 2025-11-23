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
        // WALANG GAGAWIN DITO.
        // Dati nag-a-add tayo ng title/description/image/check_list,
        // pero nandiyan na sila sa database ngayon.
        // Ginagawa na lang nating "dummy" migration para mag-pass.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Optional: wala rin tayong idi-drop dito.
        // Kung gusto mong maglagay:
        // Schema::table('services', function (Blueprint $table) {
        //     if (Schema::hasColumn('services', 'check_list')) {
        //         $table->dropColumn('check_list');
        //     }
        // });
    }
};
