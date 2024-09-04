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
        if(Schema::hasColumn('products','is_featured')){
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('is_featured');
            });
        }
        if(!Schema::hasColumn('products','is_featured')){
            Schema::table('products', function (Blueprint $table) {
                $table->boolean('is_featured')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
