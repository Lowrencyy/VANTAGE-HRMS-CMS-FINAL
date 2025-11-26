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
    Schema::create('contact_settings', function (Blueprint $table) {
        $table->id();

        // Section heading
        $table->string('section_subtitle')->default('Contact Us');
        $table->string('section_title')->default('What we do?');

        // Left heading
        $table->string('need_help_title')->default('Need Help?');
        $table->string('need_help_subtitle')->default("Reach out to the world’s most reliable IT services.");

        // Contact details
        $table->string('location_title')->default('Our Location');
        $table->string('location_text')->nullable();

        $table->string('email_title')->default('Email Us');
        $table->string('email_text')->nullable();

        $table->string('phone_title')->default('Call Us');
        $table->string('phone_text')->nullable();

        // Right side image
        $table->string('image_path')->nullable(); // e.g. "assets/img/contact-side-image.jpg"

        // Map embed (iframe src or full iframe)
        $table->text('map_embed')->nullable();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_settings');
    }
};
