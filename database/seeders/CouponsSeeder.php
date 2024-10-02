<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'vendor_id' => 0,
                'coupon_option' => 'Manual',
                'coupon_code' => 'tset10',
                'categories' => 1,
                'users' => '',
                'coupon_type' => 'Single',
                'amount_type' => 'Percentage',
                'amount'=>30,
                'expiry_date' => '2024-12-31',
                'status' => true,
            ],
            [
                'id' => 2,
                'vendor_id' => 4,
                'coupon_option' => 'Manual',
                'coupon_code' => 'tset20',
                'categories' => 1,
                'users' => '',
                'coupon_type' => 'Single',
                'amount_type' => 'Percentage',
                'amount'=>40,
                'expiry_date' => '2024-12-31',
                'status' => true,
            ],
        ];

        Coupon::insert($data);
    }
}
