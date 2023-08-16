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
        Schema::table('product_variations', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained()->onUpdate('cascade')->onDelete('cascade')->before('created_at');
            $table->dropColumn('variation_name');
            $table->foreignId('variation_id')->constrained()->onUpdate('cascade')->onDelete('cascade')->before('variation_value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_variations', function (Blueprint $table) {
            $table->string('variation_name');
            $table->dropColumn('variation_id');
            $table->dropColumn('product_id');            
        });
    }
};
