<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Services\AdminServices;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminProfileRequest;

class AdminController extends Controller
{

    public $AdminServices;
    public function __construct(AdminServices $AdminServices)
    {
        $this->AdminServices = $AdminServices;
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }


    public function profile()
    {
        return view('backend.admin.profile.index');
    }

    public function setting()
    {
        return view('backend.admin.profile.setting');
    }


    public function updateProfile(AdminProfileRequest $request){
        $validated = $request->validated();

        try {
            $this->AdminServices->updateProfile($request);
            return redirect()->back()->with("success", "Profile updated successfully");
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }


    }


    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

      try{
        $this->AdminServices->updatePassword($request);
        return redirect()->back()->with("success", "Password updated successfully");
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
      }
    }


}
