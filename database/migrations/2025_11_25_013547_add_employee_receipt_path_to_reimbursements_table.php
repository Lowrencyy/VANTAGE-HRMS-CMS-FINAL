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
        $table->string('employee_receipt_path')->nullable()->after('description');
    });
}

public function down(): void
{
    Schema::table('reimbursements', function (Blueprint $table) {
        $table->dropColumn('employee_receipt_path');
    });
}

};
