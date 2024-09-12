<?php

namespace Database\Seeders;

use App\Models\ProductsFilter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsFilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'catg_ids' => json_encode([1, 2, 3, 4, 5]),
                'filter_name' => 'Fabric',
                'filter_column' => 'fabric',
                'status' => 1
            ],
            [
                'id' => 2,
                'catg_ids' => json_encode([6, 7]),
                'filter_name' => 'RAM',
                'filter_column' => 'ram',
                'status' => 1
            ],
        ];

        ProductsFilter::insert($data);
    }
}
