<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    // // Admin after login
    // public function user_login()
    // {
    //     if (Auth::check()) {
    //         return view('frontend.layouts.main');
    //     }
    // } //end


    // admin Deshboard login system
    public function Admin_dashboard()
    {
        if (Auth()->user()->supper_admin == 1) {
            return view('admin.layouts.main');
        }
    }

    public function Admin_logout()
    {
        Auth::logout();
        $notification = array('messege' => 'Logout Successfully', 'alert-type' => 'success');
        return redirect()->route('admin_login')->with($notification);
    } // End

    public function password_change()
    {
        return view('admin.profile.change_password');
    } // End

    public function update_change(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
            // 'password_confirmation' => 'required',
        ]);

        $current_password = Auth::user()->password;

        $oldpass = $request->old_password;
        $newpass = $request->password;

        if (Hash::check($oldpass, $current_password)) {
            $user = User::findOrFail(Auth::id());

            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();


            $notification = array('messege' => 'Password Change Successfully !', 'alert-type' => 'success');
            return redirect()->route('admin_login')->with($notification);
        } else {
            $notification = array('messege' => 'Old Password Not Matched !', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    } // End Function //

    public function profile()
    {
        return view('admin.profile.main_profile');
    }
}
