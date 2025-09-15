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
           Schema::create('club_intros', function (Blueprint $table) {
        $table->id();
        $table->string('title');                // e.g. The Bangladesh Doctors Club (BDCL)
        $table->text('body')->nullable();       // বড় প্যারাগ্রাফ
        $table->json('bullet_points')->nullable(); // ["CME ...", "National campaigns", "Mentorship ..."]
        $table->string('btn1_text')->nullable(); // Discover More
        $table->string('btn1_url')->nullable();
        $table->string('btn2_text')->nullable(); // Brochure
        $table->string('btn2_url')->nullable();
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('club_intros');
    }
};
