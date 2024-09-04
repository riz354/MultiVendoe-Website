<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendorRecords = [
            [
                'id' => 1,
                'name' => 'john',
                'address' => 'bwp-12',
                'city_id' => '1',
                'state_id' => '2',
                'country_id' => '1',
                'pincode' => '2354',
                'mobile' => '0346376335',
                'email' => 'john@gmail.com',
                'status' => '0',
            ]
        ];


        Vendor::insert($vendorRecords);


    }
}
