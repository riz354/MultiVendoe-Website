<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Validation\Validator;

class UserController extends Controller
{
    public function registerPage()
    {
        return view('live.user.register');
    }
    public function loginPage()
    {
        return view('live.user.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function register(Request $request)
    {
        // dd($request->all());

        $vendor = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'status'=>0,
        ]);

        $data=[
            'name'=>'rizwan'
        ];


        // Mail::to($request->email)->send(new ConfirmVendorRegistrationEmail($data));
        return redirect()->back()->with('success','user registered successfully');
    }


    public function login(Request $request)
    {

        if ($request->isMethod('post')) {
            $validation = FacadesValidator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|min:6'
            ]);
            if ($validation->fails()) {
                return redirect()->route('admin.login')->withErrors($validation);
            }

            $user = \App\Models\User::where('email', $request->email)->first();
            if ($user && Hash::check($request->password, $user->password)) {
                Auth::login($user); // Log the user in
                return redirect()->route('home');
            } else {
                return redirect()->route('admin.login')->with('error', 'Your credentials don’t match our records.');
            }
        } else {
            return view('admin.login');
        }
    }


}
