<?php

namespace Database\Seeders;

use App\Models\VendorBusinessDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorBusinessDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => '1',
                'vendor_id' => '1',
                'shop_name' => 'john electronics',
                'shop_adress' => 'bwp-elec',
                'shop_city_id' => '1',
                'shop_state_id' => '1',
                'shop_country_id' => '1',
                'shop_pincode' => '11001',
                'shop_mobile' => '87576886767',
                'shop_website' => 'shop.com',
                'shop_email' => 'shop@gmail.com',
                'address_proof' => 'passport',
                'address_proof_image' => 'text.pnh',
                'business_license_number' => '8786543',
                'gst_number' => '7654',
                'pan_number' => '7654'
            ]
        ];

        VendorBusinessDetail::insert($data);
    }
}
