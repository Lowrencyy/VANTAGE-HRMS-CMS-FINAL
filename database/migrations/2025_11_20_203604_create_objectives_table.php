<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjectivesTable extends Migration
{
    public function up()
    {
        Schema::create('objectives', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // For objective title
            $table->text('description'); // For objective description
             $table->string('image')->nullable(); // For storing the image path
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('objectives');
    }
}
