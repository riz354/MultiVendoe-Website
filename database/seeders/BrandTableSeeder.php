<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brand = [
            [
                'id'=>1,
                'name'=>'Arrow',
                'status'=>1
            ],
            [
                'id'=>2,
                'name'=>'Samsung',
                'status'=>1
            ],
            [
                'id'=>3,
                'name'=>'Knike',
                'status'=>1
            ],

        ];

        Brand::insert($brand);

    }
}
