<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminRepository
{

    public function findAdminById()
    {
        $user = User::findOrFail(Auth::user()->id);

        return $user;
    }

    public function updateProfile($request)
    {
        $user = $this->findAdminById();

     if ($request->hasFile('photo')) {
        if ($user->photo && Storage::exists($user->photo)) {
            Storage::delete($user->photo);
        }
        $path = $request->file('photo')->store('profile/admin');
    }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'photo' => $path ,
        ]);


        return $user;
    }


    public function updatePassword($request)
    {

   

        $user = $this->findAdminById();

         if (!password_verify($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Current password does not match.');
        }

        $user->update([
            'password' => bcrypt($request->new_password),
        ]);

        return $user;
    }

}
