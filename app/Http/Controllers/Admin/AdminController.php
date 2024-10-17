<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AdminDataTable;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Country;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(Auth::guard('admin'));
        return view('admin.dashboard');
    }

    public function indexx(AdminDataTable $dataTable)
    {
        $data = [];

        return $dataTable->with($data)->render('admin.admin.index', $data);
    }
    public function login(Request $request)
    {

        if ($request->isMethod('post')) {
            $validation = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|min:6'
            ]);
            if ($validation->fails()) {
                return redirect()->route('admin.login')->withErrors($validation);
            }

            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('admin.login')->with('error', 'Your credentials don’t match our records.');
            }
        } else {
            return view('admin.login');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Successfully Logout');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function updatePassword(Request $request)
    {


        $data = [
            'admin' => Admin::where('email', Auth::guard('admin')->user()->email)->first()
        ];

        return view('admin.settings.update-passwords', $data);
    }


    public function updatePasswordPOst(Request $request)
    {
        $valiadtion = Validator::make($request->all(), [
            'c_password' => 'required|min:6',
            'n_password' => 'required|min:6|regex:/[a-z]/|regex:/[0-9]/',
            'c_n_password' => 'required|same:n_password',

        ]);

        if ($valiadtion->fails()) {
            return redirect()->route('admin.update-password')->withErrors($valiadtion);
        }

        if (Hash::check($request->c_password, Auth::guard('admin')->user()->password)) {
            if ($request->n_password == $request->c_n_password) {
                Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => Hash::make($request->n_password)]);

                return redirect()->route('admin.update-password')->with('success', 'Passsowrd is updated successfully');
            } else {
                return redirect()->route('admin.update-password')->with('error', 'New passsowrd is not matching with confirm password');
            }
        } else {
            return redirect()->route('admin.update-password')->with('error', 'Current passsowrd is incorrect');
        }
    }
    /**
     * Display the specified resource.
     */
    public function checkAdminPassword(Request $request)
    {
        // $request->validate([
        //     'pwd'=>'required|min:6'
        // ]);
        $validate = Validator::make($request->all(), [
            'pwd' => 'required|min:6'
        ]);
        if ($validate->fails()) {
            return response()->json([
                'validation' => $validate->errors()
            ]);
        }

        if (Hash::check($request->pwd, Auth::guard('admin')->user()->password)) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function updateAdminDetails(Request $request)
    {

        // dd($request->all());
        if ($request->isMethod('post')) {

            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
                'mobile_no' => 'required|numeric',
                'file' => 'required|array',
                'file.*' => 'required|string'
            ];
            $request->validate($rules);
            try {

                $storedFilePaths = [];
                if (isset($request->file)) {
                    $storedFilePaths = [];
                    if (!Storage::exists('public/admin')) {
                        Storage::makeDirectory('public/admin');
                    }
                    foreach ($request->file as $filename) {
                        $tempPath = 'temp/' . $filename;
                        $newPath = 'public/admin/' . $filename;
                        if (Storage::exists($tempPath)) {
                            Storage::move($tempPath, $newPath);
                            $storedFilePaths[] = 'admin/' . $filename;
                            Storage::delete($tempPath);
                        } else {
                        }
                    }
                }
                DB::transaction(function () use ($request, $storedFilePaths) {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['name' => $request->name, 'mobile' => $request->mobile_no, 'image' => $storedFilePaths[0]]);
                });
                return redirect()->route('admin.update-admin-details')->with('success', 'Admin Details Updated Successfully');
            } catch (\Throwable $th) {
                return redirect()->route('admin.update-admin-details')->with('error', 'Something went wrong');
            }
        }
        $data = [
            'admin' => Admin::where('email', Auth::guard('admin')->user()->email)->first()
        ];

        return view('admin.settings.update-admin-details', $data);
    }
















    public function updateVendorDetails(Request $request,  $slug)
    {


        if ($request->isMethod('post')) {
            // dd($request->all());
            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
                'mobile_no' => 'required|numeric',

            ];
            $request->validate($rules);
            // try {

                $storedFilePaths = [];
                if (isset($request->file)) {
                    $storedFilePaths = [];
                    if (!Storage::exists('public/vendor')) {
                        Storage::makeDirectory('public/vendor');
                    }
                    foreach ($request->file as $filename) {
                        $tempPath = 'temp/' . $filename;
                        $newPath = 'public/vendor/' . $filename;
                        if (Storage::exists($tempPath)) {
                            Storage::move($tempPath, $newPath);
                            $storedFilePaths[] = 'vendor/' . $filename;
                            Storage::delete($tempPath);
                        } else {
                        }
                    }
                }
                DB::transaction(function () use ($request, $storedFilePaths) {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['name' => $request->name, 'mobile' => $request->mobile_no, 'image' => $storedFilePaths[0]]);

                    Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->update(['address' => $request->address, 'country_id' => $request->residential_country, 'state_id' => $request->residential_state,
                    'pincode' => $request->pin_code,]);

                });
                return redirect()->route('admin.update-vendor-details',['slug'=>'personal'])->with('success', 'Vendor Details Updated Successfully');
            // } catch (\Throwable $th) {
            //     return redirect()->route('admin.update-vendor-details',['slug'=>'personal'])->with('error', 'Something went wrong');
            // }
        } else {
            if ($slug == 'personal') {
                $vendor = Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->first();
                $admin =Admin::where('id', Auth::guard('admin')->user()->id)->first();
                $countries = Country::select('id', 'name')->get();
            }

            $data = [
                'slug' => $slug,
                'vendor' => $vendor,
                'countries' => $countries,
                'admin'=>$admin
            ];
            return view('admin.settings.vendor.update-vendor-details', $data);
        }
    }


    public function edit($id)
    {
        $user = User::find($id);
        $hasRoles = [];
        if(isset($user->roles)){
            $hasRoles = $user->roles->pluck('id')->toArray();
        }
        $data =[
            'admin'=>$user,
            'roles'=>Role::get(),
            'hasRoles'=>  $hasRoles
        ];

        return view('admin.admin.edit',$data);
    }

    public function update(Request $request , $id)
    {

        $admin = User::find($id);
      $admin->syncRoles($request->role);

        return redirect()->route('admin.index')->with('success', 'Admin Updated Successfully');

    }
}
