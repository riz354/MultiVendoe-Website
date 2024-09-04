<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'name' => 'Super Admin',
                'type' => 'super-admin',
                'vendor_id' => '0',
                'mobile' => '03460479354',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('123456'),
                'image' => '',
                'status' => '1',
            ],
            [
                'id' => 2,
                'name' => 'john',
                'type' => 'vendor',
                'vendor_id' => '1',
                'mobile' => '03460479354',
                'email' => 'john@gmail.com',
                'password' => Hash::make('123456'),
                'image' => '',
                'status' => '0',
            ]
        ];

        foreach ($data as $item) {
            Admin::updateOrCreate(
                ['id' => $item['id']],
                $item 
            );
        }
    }
}
