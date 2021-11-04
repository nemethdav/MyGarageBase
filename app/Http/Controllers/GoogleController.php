<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function loginWithGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function callbackFromGoogle(){
        try {
            try {
                $user = Socialite::driver('google')->user();

                $finduser = User::where('email', $user->getEmail())->first();

                if($finduser){
                    $finduser->update([
                        'google_id' => $user->getId()
                    ]);
                    Auth::login($finduser);
                    return redirect()->intended(route('home'));
                }else{
                    $newUser = User::create([
                        'name' => $user->getName(),
                        'email' => $user->getEmail(),
                        'google_id'=> $user->getId(),
                        'password' => Hash::make($user->getName().'@'.$user->getId())
                    ]);
                    Auth::login($newUser);
                    return redirect()->intended(route('home'));
                }

            } catch (Exception $e) {
                dd($e->getMessage());
            }
        } catch (\Throwable $throwable){
            throw $throwable;
        }
    }
}
