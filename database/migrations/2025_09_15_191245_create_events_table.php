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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
             $table->string('title');
            $table->text('description');
            $table->dateTime('event_date');
            $table->dateTime('end_date'); // নতুন ফিল্ড: শেষ তারিখ
            $table->integer('max_registrations')->nullable(); // সর্বাধিক রেজিস্ট্রেশন সংখ্যা
            $table->boolean('is_free')->default(true); // ফ্রি/পেইড ইভেন্ট
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
