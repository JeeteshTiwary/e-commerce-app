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
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('base_price');
            $table->dropColumn('sale_price');
            $table->dropColumn('featured_image');
            $table->dropColumn('color_id');
            $table->dropColumn('size_id');
            $table->dropColumn('status_id');
            $table->dropColumn('flag_id');
            $table->dropColumn('category_id');
            $table->dropColumn('brand_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
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
        });
    }
};
