<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(){
        $data = [
            'permissions'=>Permission::orderBy('created_at','DEsc')->paginate(2),
        ];

        return view('admin.permission.index',$data);

    }
}
