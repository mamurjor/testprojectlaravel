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
          Schema::create('president_messages', function (Blueprint $table) {
        $table->id();
        $table->string('heading')->default('President Message');
        $table->string('person_name');          // e.g. Dr. Jacob Jones
        $table->string('person_title')->nullable(); // e.g. President, BDCL
        $table->string('avatar')->nullable();   // storage path
        $table->text('quote');                  // কোট টেক্সট
        $table->string('badge_text')->nullable();  // e.g. 2016
        $table->string('read_more_url')->nullable();
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('president_messages');
    }
};
