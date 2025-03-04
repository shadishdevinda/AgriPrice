<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('center_has_fruit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('center_id')->constrained('economic_centers')->onDelete('cascade');
            $table->foreignId('fruit_id')->constrained('fruits')->onDelete('cascade');
            $table->decimal('fruit_wholesale_price', 8, 2);
            $table->decimal('fruit_retail_price', 8, 2);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('center_has_fruit');
    }
};
