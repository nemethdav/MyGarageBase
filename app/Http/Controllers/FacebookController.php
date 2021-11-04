<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    /**
     * Login Using Facebook
     */
    public function loginUsingFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFromFacebook()
    {
        try {
            $user = Socialite::driver('facebook')->user();

            $finduser = User::where('email', $user->getEmail())->first();

            if($finduser){
                $finduser->update([
                    'facebook_id' => $user->getId()
                ]);
                Auth::login($finduser);
                return redirect()->intended(route('home'));
            }else{
                $newUser = User::create([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'facebook_id'=> $user->getId(),
                    'password' => Hash::make($user->getName().'@'.$user->getId())
                ]);
                Auth::login($newUser);
                return redirect()->intended(route('home'));
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }

    }
}
