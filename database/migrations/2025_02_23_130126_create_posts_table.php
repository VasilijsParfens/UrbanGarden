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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Author of the post
            $table->enum('type', ['tip', 'question', 'showcase', 'plant_identification']); // Type of post
            $table->string('title', 255)->nullable(); // Limit title to 255 characters, optional for some types
            $table->text('content')->nullable()->length(5000); // Limit content to 5000 characters, optional for some types
            $table->string('image', 255)->nullable(); // Path to the image, limit to 255 characters, optional for some types
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
