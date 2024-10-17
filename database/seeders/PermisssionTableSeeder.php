<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PhpParser\Node\Stmt\Foreach_;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermisssionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'name' => 'admin.catalogue.brand.create',
                'guard_name' => 'web',
                'show_name' => 'Can Create Brands',
                'title' => 'Brand'
            ],
            [
                'name' => 'admin.catalogue.brand.edit',
                'guard_name' => 'web',
                'show_name' => 'Can Edit Brands',
                'title' => 'Brand'
            ],
            [
                'name' => 'admin.catalogue.brand.delete',
                'guard_name' => 'web',
                'show_name' => 'Can Delete Brands',
                'title' => 'Brand'
            ]
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                [
                    'name' => $permission['name'],
                    'guard_name' => $permission['guard_name']
                ],
                [
                    'show_name' => $permission['show_name'],
                    'title' =>  $permission['title']
                ]
            );
        }


        // (new Role())->find(1)->givePermissionTo(new Permission());
        // $childRoles =  Role::where('parent_id',1)->where('is_child',true)->get();
        // $parentRole =  (new Role())->find(1);

        // foreach($childRoles as $childRole){
        //     $childRole->givePermissionTo($parentRole->permissions);
        // }


    }
}
