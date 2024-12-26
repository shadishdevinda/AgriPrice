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
        // Create vegetable table
        Schema::create('vegetable', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('Wholesale Price');
            $table->string('Retail Price');
            $table->string('photo_path', 2048);
            $table->timestamps();
        });

        // Create center_has_vegetable table
        Schema::create('center_has_vegetable', function (Blueprint $table) {
            $table->id();

            // Foreign key to economic_center table using a string `id`
            $table->string('center_id'); // Make sure the foreign column is a string
            $table->foreign('center_id')  // Define the foreign key relationship
                ->references('id')         // The `id` column in the `economic_center` table
                ->on('economic_center')    // The `economic_center` table
                ->onDelete('cascade');     // Ensure cascading delete behavior

            // Foreign key to vegetable table
            $table->foreignId('vegetable_id')
                ->constrained('vegetable')
                ->onDelete('cascade');

            $table->timestamps();
        });

        // Create vegetable_has_advice table
        Schema::create('vegetable_has_advice', function (Blueprint $table) {
            $table->id();

            // Foreign key to advice table
            $table->foreignId('advice_id')
                ->constrained('vegetable_advice')
                ->onDelete('cascade');

            // Foreign key to vegetable table
            $table->foreignId('vegetable_id')
                ->constrained('vegetable')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the center_has_vegetable table first to avoid foreign key conflicts
        Schema::dropIfExists('vegetable_has_advice');

        // Drop the center_has_vegetable table first to avoid foreign key conflicts
        Schema::dropIfExists('center_has_vegetable');

        // Drop the vegetable table
        Schema::dropIfExists('vegetable');
    }
};
