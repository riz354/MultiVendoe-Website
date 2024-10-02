<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmVendorRegistrationEmail;
use App\Models\Admin;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function registerPage()
    {
        return view('live.vendor.register');
    }
    public function loginPage()
    {
        return view('admin.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function register(Request $request)
    {
        // dd($request->all());

        $vendor = Vendor::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'mobile'=>$request->mobile_no,
            'status'=>0,
        ]);

        $admin = Admin::create([
            'type'=>'vendor',
            'vendor_id'=>$vendor->id,
            'name'=>$request->name,
            'mobile'=>$request->mobile_no,
            'email'=>$request->email,
            'password'=>$request->password,
            'status'=>0,
        ]);

        $data=[
            'name'=>'rizwan'
        ];


        Mail::to($request->email)->send(new ConfirmVendorRegistrationEmail($data));
        return redirect()->back()->with('success','vendor registered successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
