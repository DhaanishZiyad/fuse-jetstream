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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Auto-incrementing product ID
            $table->string('name'); // Name of the product
            $table->decimal('old_price', 10, 2)->nullable(); // Old price (nullable if no old price exists)
            $table->decimal('current_price', 10, 2); // Current price
            $table->string('image_path'); // Path to the product image
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
