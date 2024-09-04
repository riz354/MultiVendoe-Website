<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product = [
            [
                'id'=>1,
                'section_id'=>2,
                'category_id'=>2,
                'brand_id'=>4,
                'vendor_id'=>1,
                'admin_type'=>'vendor',
                'product_name'=>'REdmi NOte 11',
                'product_code'=>'Rn11',
                'product_color'=>'blue',
                'product_price'=>'1500',
                'product_discount'=>'565',
                'product_weight'=>'200',
                'product_image'=>'',
                'product_video'=>'',
                'description'=>'theer is no description',
                'meta_title'=>'titke',
                'meta_description'=>'sqs',
                'meta_keywords'=>'qsq,qsq',
                'is_featured'=>'Yes',
                'status'=>1
            ],

            [
                'id'=>2 ,
                'section_id'=>1,
                'category_id'=>1,
                'brand_id'=>3,
                'vendor_id'=>0,
                'admin_type'=>'super-admin',
                'product_name'=>'casual t-shirts',
                'product_code'=>'Rn11',
                'product_color'=>'REd',
                'product_price'=>'1500',
                'product_discount'=>'565',
                'product_weight'=>'200',
                'product_image'=>'',
                'product_video'=>'',
                'description'=>'theer is no description',
                'meta_title'=>'titke',
                'meta_description'=>'sqs',
                'meta_keywords'=>'qsq,qsq',
                'is_featured'=>'Yes',
                'status'=>1
            ]
        ];

        Product::insert($product);
    }
}
