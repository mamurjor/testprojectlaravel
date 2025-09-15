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
    Schema::table('users', function (Blueprint $table) {
        $table->string('full_name_en')->nullable();
        $table->string('full_name_bn')->nullable();
        $table->string('profile_photo')->nullable();
        $table->string('cover_banner')->nullable();
        $table->string('medical_registration_number')->nullable();
        $table->string('specialization')->nullable();
        $table->string('current_designation')->nullable();
        $table->string('institution_name')->nullable();
        $table->string('image_gallery')->nullable();
        $table->string('notification_preferences')->nullable();
        $table->integer('years_of_experience')->nullable();
        $table->string('educational_background')->nullable();
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
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn([
            'full_name_en',
            'full_name_bn',
            'profile_photo',
            'cover_banner',
            'medical_registration_number',
            'specialization',
            'current_designation',
            'institution_name',
            'image_gallery',
            'notification_preferences',
            'years_of_experience',
            'educational_background',
            'certifications_and_fellowships',
            'areas_of_interest',
            'languages_spoken',
            'phone',
            'location',
            'short_bio',
            'personal_website',
            'linkedin',
            'researchgate',
            'cv',
            'social_links',
            'membership_id',
            'membership_level',
        ]);
    });
}
};
