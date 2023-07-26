<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->longText('description');
            $table->integer('base_price');
            $table->integer('sale_price');
            $table->string('featured_image')->unique();
            $table->foreignId('color_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('size_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('status_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('flag_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('brand_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');  
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