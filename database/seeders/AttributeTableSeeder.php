<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attribute = [
            [
                'id'=>1,
                'product_id' => 1,
                'size' => 'small',
                'price' => 1500,
                'stock' => 50,
                'sku' => 'RCU001-S',
                'status' => 1
            ],
            [
                'id'=>2,

                'product_id' => 1,
                'size' => 'large',
                'price' => 1600,
                'stock' => 50,
                'sku' => 'RCU001-S',
                'status' => 1
            ],
            [
                'id'=>3,

                'product_id' => 1,
                'size' => 'medium',
                'price' => 1550,
                'stock' => 50,
                'sku' => 'RCU001-S',
                'status' => 1
            ]
        ];

        Attribute::insert($attribute);
    }
}
