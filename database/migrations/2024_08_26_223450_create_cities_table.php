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
        if (!Schema::hasTable('cities')) {
            Schema::create('cities', function (Blueprint $table) {
                $table->id();
                $table->string('name')->nullable();
                $table->bigInteger('state_id')->nullable();
                $table->string('state_code')->nullable();
                $table->unsignedInteger('country_id')->index()->nullable();
                $table->string('country_code')->nullable();
                $table->string('latitude')->nullable();
                $table->string('longitude')->nullable();
                $table->boolean('flag')->default(false);
                $table->string('wikiDataId')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
