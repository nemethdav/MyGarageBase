<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update the profile
     *
     * @param \App\Http\Requests\ProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->withStatus(__('Sikeres profilmodosítás!'));
    }

    /**
     * Change the password
     *
     * @param \App\Http\Requests\PasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withStatusPassword(__('Sikeres jelszómodosítás!'));
    }

    function avatar(Request $request)
    {
        $dest = 'storage/imgs/avatars/'; //Where user images will be stored

        if (($file = $request->file('changeAvatar')) != null) {
            $new_image_name = auth()->user()->name . 'Avatar' . uniqid() . "." . $request->changeAvatar->getClientOriginalExtension();
            //Upload file
            $move = $file->move(public_path($dest), $new_image_name);

            //Delete old image if exist
            $oldUserPhoto = auth()->user()->avatar;
            if ($oldUserPhoto != null) {
                unlink($dest . $oldUserPhoto);
            }

            //Update new picture in database
            auth()->user()->update(['avatar' => "/" . $new_image_name]);
            return back()->withStatusAvatar(__('Profilkép módosítása sikeresem megtörtént!'));
        } else {
            return back()->withStatusErrorAvatar(__('Hiba a kép módosítása közben. Kérem adjon meg egy fájlt!'));
        }
    }
}
