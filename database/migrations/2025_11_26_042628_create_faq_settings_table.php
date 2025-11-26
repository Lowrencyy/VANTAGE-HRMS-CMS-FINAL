<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 public function up()
{
    Schema::create('faq_settings', function (Blueprint $table) {
        $table->id();

        $table->string('subtitle')->default('FAQ');
        $table->string('title')->default('Most common question about our services');
        $table->string('button_text')->default('View All');
        $table->string('button_link')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faq_settings');
    }
};
