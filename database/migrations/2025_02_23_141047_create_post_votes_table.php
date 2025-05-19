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
        Schema::create('post_votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User who voted
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade'); // Post being voted on
            $table->boolean('is_upvote')->default(true); // True for upvote, false for downvote
            $table->timestamps();

            // Ensure a user can only vote once per post
            $table->unique(['user_id', 'post_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_votes');
    }
};
