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
        Schema::create('membership_assignments', function (Blueprint $table) {
            $table->id();
        $table->foreignId('doctor_id')->constrained()->cascadeOnDelete();
        $table->foreignId('membership_level_id')->constrained('membership_levels')->cascadeOnDelete();
        $table->foreignId('assigned_by')->nullable()->constrained('users')->nullOnDelete(); // কে অ্যাসাইন করেছে
        $table->timestamp('starts_at')->nullable();
        $table->timestamp('ends_at')->nullable(); // duration_days থাকলে অটো ক্যাল্কুলেট করা যেতে পারে
        $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership_assignments');
    }
};
