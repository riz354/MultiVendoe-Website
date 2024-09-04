<?php

namespace Database\Seeders;

use App\Models\VendorBankDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorBankDetailsTableSeeder extends Seeder
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
                'account_holder_name' => 'john',
                'account_number' => '87654345678',
                'bank_ifsc_code' => '765435'
            ]
        ];

        VendorBankDetail::insert($data);
    }
}
