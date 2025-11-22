<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('why_choose', function (Blueprint $table) {
            $table->id();

            // general content
            $table->string('background_image')->nullable();
            $table->string('banner_title')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();

            // 4 business solutions
            $table->string('solution_title_1')->nullable();
            $table->string('solution_title_2')->nullable();
            $table->string('solution_title_3')->nullable();
            $table->string('solution_title_4')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('why_choose');
    }
};
