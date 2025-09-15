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
        Schema::create('membership_levels', function (Blueprint $table) {
            $table->id();
            $table->string('name');              // Basic, Premium, Lifetime, Founder
            $table->string('slug')->unique();    // basic, premium, lifetime, founder
            $table->unsignedInteger('duration_days')->nullable(); // lifetime হলে null
            $table->decimal('price', 10, 2)->default(0);          // চাইলে
            $table->boolean('is_lifetime')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership_levels');
    }
};
