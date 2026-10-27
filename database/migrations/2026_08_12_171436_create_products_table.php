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
            $table->id();
            
            $table->foreignId('category_id')->constrained()->onDelete('cascade');

            $table->String('name_pd');
            $table->String('slug')->unique();
            // $table->String('sku')->unique()->nullable();
            $table->String('image')->nullable();

            $table->decimal('price', 15, 2);
            $table->decimal('sale_price', 15, 2)->nullable();

            // $table->string('material')->nullable(); // Chất liệu
            
            $table->text('short_description')->nullable();
            $table->longtext('description')->nullable();

            $table->boolean('is_featured')->default(false); 
            $table->boolean('status')->default(true);
            $table->timestamps();
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
