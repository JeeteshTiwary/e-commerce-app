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
        Schema::create('product__details', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->foreignId('status')->default('0')->comment('0-un');
            $table->decimal('base_price')->nullable();
            $table->decimal('sale_price')->nullable();
            $table->integer('quantity_on_shelf')->nullable();
            $table->integer('quantity_in_warehouse')->nullable();
            $table->string('thumbnail')->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product__details');
    }
};
