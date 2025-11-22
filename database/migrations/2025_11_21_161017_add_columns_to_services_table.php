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
    Schema::table('services', function (Blueprint $table) {
        $table->string('title');          // Add title column
        $table->text('description');      // Add description column
        $table->string('image')->nullable(); // Add image column
        $table->text('check_list');       // Add check_list column
    });
}

public function down()
{
    Schema::table('services', function (Blueprint $table) {
        $table->dropColumn(['title', 'description', 'image', 'check_list']);
    });
}

};
