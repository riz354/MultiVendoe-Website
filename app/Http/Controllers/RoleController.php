<?php

namespace App\Http\Controllers;

use App\DataTables\BrandDataTable;
use App\DataTables\RoleDataTable;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(RoleDataTable $dataTable)
    {
        $data = [];

        return $dataTable->with($data)->render('admin.role.index', $data);
    }


    public function create()
    {
        $data = [
            'permissions' => Permission::all(),
        ];

        return view('admin.role.create', $data);
    }


    public function edit($id)
    {
        $role =  Role::where('id', $id)->first();
        $role_permissions =[];
        if(isset($role->permissions)){
            $role_permissions = $role->permissions->pluck('id')->toArray();
        }

        // dd($role_permissions);

        $data = [
            'role' =>  Role::where('id', $id)->first(),
            'permissions' => Permission::all(),
            'role_permissions'=>$role_permissions,

        ];


        return view('admin.role.edit', $data);
    }

    public function update(Request $request, $id)
    {

        $rolee =  Role::where('id', $id)->first();
        $rules = [
            'name' => 'required',

        ];
        $request->validate($rules);
        $role = Role::where('id', $id)->update([
            'name' => $request->name,
        ]);



        if(!empty($request->permission)){
                $rolee->syncPermissions($request->permission);
        }else{
            $role->syncPermissions([]);

        }

        return redirect()->route('admin.role.index')->with('success', 'Role Updated Successfully');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $rules = [
            'name' => 'required',
        ];

        $request->validate($rules);
        $role = Role::create([
            'name' => $request->name,
        ]);

        if(!empty($request->permission)){
            foreach($request->permission as $value){
                $role->givePermissionTo($value);
            }
        }


        return redirect()->route('admin.role.index')->with('success', 'Role Created Successfully');
    }

    public function delete($id)
    {

        $role =  Role::where('id', $id)->first();
        $role->delete();
        return redirect()->route('admin.role.index')->with('success', 'Role deleted Successfully');
    }

}
