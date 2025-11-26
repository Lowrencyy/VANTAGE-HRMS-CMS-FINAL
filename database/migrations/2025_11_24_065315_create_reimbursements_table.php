<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reimbursements', function (Blueprint $table) {
            $table->id();

            // Employee na nag-request (link to users table)
            $table->unsignedBigInteger('employee_id');

            // Basic info
            $table->decimal('amount', 12, 2);
            $table->string('title')->nullable();
            $table->text('description')->nullable();

            // Employee receipt path (image/pdf)
            $table->string('employee_receipt')->nullable();

            // HR payment receipt path
            $table->string('hr_receipt_path')->nullable();

            // Status ng request: pending / approved / denied / paid
            $table->string('status', 20)->default('pending');

            // Sino nag-approve / deny / nag-mark as paid
            $table->unsignedBigInteger('approved_by')->nullable();

            // Kailan nag-decide si HR (approve/deny/paid)
            $table->timestamp('decision_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reimbursements');
    }
};
