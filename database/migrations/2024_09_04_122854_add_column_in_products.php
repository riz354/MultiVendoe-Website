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

        if(!Schema::hasColumn('products','admin_id')){
            Schema::table('products', function (Blueprint $table) {
                $table->integer('admin_id')->nullable();
            });
        }
        if(!Schema::hasColumn('products','admin_type')){
            Schema::table('products', function (Blueprint $table) {
                $table->integer('admin_type')->nullable();
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
