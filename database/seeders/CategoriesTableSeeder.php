<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'parent_id' => 0,
                'section_id' => 1,
                'category_name' => 'Men',
                'category_discount' => '12',
                'description' => 'first',
                'url' => 'ghtt',
                'meta_title' => 'sss',
                'meta_description' => 'ss',
                'meta_keywords' => 'ss'
            ]
        ];

        Category::insert($data);
    }
}
