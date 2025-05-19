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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50); // Limit name to 50 characters
            $table->string('email', 100)->unique(); // Limit email to 100 characters
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 100); // Limit password to 100 characters
            $table->string('profile_picture', 255)->nullable();
            $table->boolean('is_admin')->default(false);
            $table->rememberToken();
            $table->timestamps();

            // Add indexes for frequently searched fields
            $table->index('email');
            $table->index('is_admin');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email', 100)->primary(); // Limit email to 100 characters
            $table->string('token', 100); // Limit token to 100 characters
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id', 100)->primary(); // Limit ID to 100 characters
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // Foreign key constraint
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent', 255)->nullable(); // Limit user agent to 255 characters
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
