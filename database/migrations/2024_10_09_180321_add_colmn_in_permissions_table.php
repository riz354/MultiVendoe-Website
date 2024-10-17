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

        if (!Schema::hasColumn('permissions', 'show_name')) {
            Schema::table('permissions', function (Blueprint $table) {
                $table->string('show_name')->nullable();
            });
        }


        if (!Schema::hasColumn('permissions', 'title')) {
            Schema::table('permissions', function (Blueprint $table) {
                $table->string('title')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            //
        });
    }
};
