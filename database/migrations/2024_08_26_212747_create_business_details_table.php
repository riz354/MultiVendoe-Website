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
        Schema::create('vendor_business_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vendor_id')->nullable();
            $table->string('shop_name')->nullable();
            $table->string('shop_adress')->nullable();
            $table->string('shop_city_id')->nullable();
            $table->string('shop_state_id')->nullable();
            $table->string('shop_country_id')->nullable();
            $table->string('shop_pincode')->nullable();
            $table->string('shop_mobile')->nullable();
            $table->string('shop_website')->nullable();
            $table->string('shop_email')->nullable();
            $table->string('address_proof')->nullable();
            $table->string('address_proof_image')->nullable();
            $table->string('business_license_number')->nullable();
            $table->string('gst_number')->nullable();
            $table->string('pan_number')->nullable();




            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_details');
    }
};
