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
        Schema::create('plants', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100); // Plant common name
            $table->string('scientific_name', 150); // Botanical name
            $table->string('image', 255)->nullable();

            // Fixed options for watering frequency
            $table->enum('watering_frequency', ['Daily', 'Weekly', 'Bi-Weekly', 'Monthly']);

            // Fixed options for sunlight requirements
            $table->enum('sunlight', ['Full Sun', 'Partial Sun', 'Shade', 'Indirect Light']);

            // Fixed options for soil types
            $table->enum('soil_type', ['Sandy', 'Clay', 'Loamy', 'Peaty', 'Chalky', 'Silty']);

            // Fixed options for fertilizing frequency
            $table->enum('fertilizing', ['Weekly', 'Bi-Weekly', 'Monthly', 'Quarterly', 'Rarely']);

            $table->text('additional_info')->nullable();
            $table->timestamps();

            // Indexes for search performance
            $table->index('name');
            $table->index('scientific_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plants');
    }
};
