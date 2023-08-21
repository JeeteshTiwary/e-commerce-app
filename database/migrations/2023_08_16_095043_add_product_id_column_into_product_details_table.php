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
        Schema::table('product_details', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained()->onUpdate('cascade')->onDelete('cascade')->before('created_at');
            $table->tinyInteger('status')->default('1')->comment('0-unpublished, 1-published, 2-scheduled')->change();   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_details', function (Blueprint $table) {
            $table->dropColumn('product_id');
            $table->foreignId('status')->default('0');
        });
    }
};
