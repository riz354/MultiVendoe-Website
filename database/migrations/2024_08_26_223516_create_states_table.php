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

        if (!Schema::hasTable('states')) {
            Schema::create('states', function (Blueprint $table) {
                $table->id();
                $table->string('name')->nullable();
                $table->bigInteger('country_id')->nullable();
                $table->string('country_code')->nullable();
                $table->string('fips_code')->nullable();
                $table->string('iso2')->nullable();
                $table->string('latitude')->nullable();
                $table->string('longitude')->nullable();
                $table->boolean('flag')->default(0);
                $table->text('wikiDataId')->nullable();
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
        Schema::dropIfExists('states');
    }
};
