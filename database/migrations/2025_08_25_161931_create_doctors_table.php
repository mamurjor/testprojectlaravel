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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
               $table->string('name');
        $table->string('email')->unique();
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');

        $table->string('full_name_en')->nullable();
        $table->string('full_name_bn')->nullable();
        $table->string('profile_photo')->nullable();
        $table->string('cover_banner')->nullable();
        $table->string('medical_registration_number')->nullable();
        $table->string('specialization')->nullable();
        $table->string('current_designation')->nullable();
        $table->string('institution_name')->nullable();
        $table->text('image_gallery')->nullable();
        $table->text('notification_preferences')->nullable();
        $table->integer('years_of_experience')->nullable();
        $table->text('educational_background')->nullable();
        $table->text('certifications_and_fellowships')->nullable();
        $table->text('areas_of_interest')->nullable();
        $table->string('languages_spoken')->nullable();
        $table->string('phone')->nullable();
        $table->string('location')->nullable();
        $table->text('short_bio')->nullable();
        $table->string('personal_website')->nullable();
        $table->string('linkedin')->nullable();
        $table->string('researchgate')->nullable();
        $table->string('cv')->nullable();
        $table->string('social_links')->nullable();
        $table->string('membership_id')->nullable();
        $table->string('membership_level')->nullable();
         $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
