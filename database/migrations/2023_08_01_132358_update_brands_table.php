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
        Schema::table('brands', function (Blueprint $table) {
            $table->string('url')->nullable()->change();
            $table->string('description')->nullable();
            $table->tinyInteger('status')->default('1')->comment('0-unpublished, 1-published, 2-scheduled');
            $table->unsignedBigInteger('created_by')->nullable()->change();
            $table->unsignedBigInteger('updated_by')->nullable()->change(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->string('url')->nullable();
            $table->dropColumn('status');
            $table->dropColumn('description');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');  
        });
    }
};
