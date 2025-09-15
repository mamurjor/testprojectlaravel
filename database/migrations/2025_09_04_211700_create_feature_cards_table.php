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
          Schema::create('feature_cards', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('description', 500)->nullable();
        $table->string('icon_class')->nullable();     // e.g. "bi-people-fill"
        $table->string('accent_color', 20)->nullable(); // e.g. "#0ea5a8" বা "teal"
        $table->unsignedInteger('sort_order')->default(0);
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feature_cards');
    }
};
