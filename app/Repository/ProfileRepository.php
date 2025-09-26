<?php

namespace App\Repository;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileRepository
{
    // Profile repository methods would go here



   public function profileUpdate($request)
{
    $user = User::find(Auth::id());
    $path = $user->photo;

    if ($request->hasFile('photo')) {
        if ($user->photo && Storage::exists($user->photo)) {
            Storage::delete($user->photo);
        }
        $path = $request->file('photo')->store('profile/instructor');
    }

    $user->update([
        'first_name' => $request->input('first_name'),
        'last_name'  => $request->input('last_name'),
        'name'       => $request->input('name'),
        'email'      => $request->input('email'),
        'phone'      => $request->input('phone'),
        'address'    => $request->input('address'),
        'photo'      => $path,
        'bio'        => $request->input('bio'),
        'city'       => $request->input('city'),
        'country'    => $request->input('country'),
    ]);
}


    public function updatePassword($request)
    {
        $user = User::find(Auth::id());

        if (!password_verify($request->input('current_password'), $user->password)) {
            throw new \Exception('Current password is incorrect.');
        }

        $user->update([
            'password' => bcrypt($request->input('new_password')),
        ]);
    }
}
