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
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->json('name'); // translatable: en, id
            $table->json('slug'); // translatable: en, id
            $table->json('short_description')->nullable(); // translatable
            $table->json('body_content')->nullable(); // translatable
            $table->string('body_content_pos')->default('left'); // left or right
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collections');
    }
};
