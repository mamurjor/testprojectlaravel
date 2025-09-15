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
        Schema::create('comments', function (Blueprint $table) {
             $table->id();
            $table->foreignId('post_id')->constrained('posts')->cascadeOnDelete();
            $table->foreignId('parent_id')->nullable()->constrained('comments')->nullOnDelete();

            // guest fields (user না থাকলেও কেমন্ট করা যাবে)
            $table->string('name');
            $table->string('email');
            $table->string('website')->nullable();

            $table->text('body');

            // moderation
            $table->enum('status', ['pending','approved','spam'])->default('pending');

            // meta (useful for moderation/analytics)
            $table->string('ip', 45)->nullable();
            $table->string('user_agent')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
