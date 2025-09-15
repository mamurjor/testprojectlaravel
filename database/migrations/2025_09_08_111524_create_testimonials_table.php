<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role')->nullable();              // e.g. Member, CEO
            $table->text('quote');                           // testimonial text
            $table->unsignedTinyInteger('rating')->default(5); // 1..5
            $table->string('avatar_path')->nullable();       // uploads path
            $table->string('avatar_url')->nullable();        // external url
            $table->boolean('is_active')->default(true);     // show/hide in carousel
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('testimonials');
    }
};
