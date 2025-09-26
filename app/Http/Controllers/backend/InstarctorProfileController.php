<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;

class InstarctorProfileController extends Controller
{

    public $profileServices;
    public function __construct( \App\Services\ProfileServices $profileServices)
    {
        $this->profileServices = $profileServices;
    }
    public function index()
    {
        return view('backend.instructor.profile.index');
    }


    public function store(ProfileRequest $request){


       $validated =  $request->validated();
        try {
            $this->profileServices->profileUpdate($request);
            return redirect()->back()->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the profile: ' . $e->getMessage());
        }
    }
     public function setting()
    {
        return view('backend.instructor.profile.setting');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        try {
            $this->profileServices->updatePassword($request);
            return redirect()->back()->with('success', 'Password updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the password: ' . $e->getMessage());
        }
    }
}
