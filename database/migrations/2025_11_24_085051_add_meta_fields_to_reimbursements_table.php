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
        Schema::table('reimbursements', function (Blueprint $table) {
            // Who approved / denied / marked paid
            $table->unsignedBigInteger('approved_by')
                ->nullable()
                ->after('status');

            // When HR decided (approve / deny / paid)
            $table->timestamp('decision_at')
                ->nullable()
                ->after('approved_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reimbursements', function (Blueprint $table) {
            $table->dropColumn(['approved_by', 'decision_at']);
        });
    }
};
