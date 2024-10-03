<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFacebook()
    {

        try {
            $facebook_user =  Socialite::driver('facebook')->user();
            $user = User::where('facebook_id', $facebook_user->getId())->first();
            if (!$user) {
                $new_user = User::create([
                    'name' => $facebook_user->getName(),
                    'email' => $facebook_user->getEmail(),
                    'facebook_id' => $facebook_user->getId(),

                ]);

                Auth::login($new_user);
                return redirect()->route('home');
            } else {
                Auth::login($user);
            }
        } catch (\Throwable $th) {

            dd('something wrong', $th->getMessage());
        }
    }
}
