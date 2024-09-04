<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $section = [
            [
                'id'=>1,
                'name'=>'Cloths',
                'status'=>1,
            ],
            [
                'id'=>2,
                'name'=>'Electronics',
                'status'=>1,
            ],
            [
                'id'=>3,
                'name'=>'Appliances',
                'status'=>1,
            ],
        ];

        Section::insert($section);
    }
}
