<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

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


    /**
     * Display the admin dashboard.
     *
     * This method determines whether the authenticated user is a super admin. If the user is a super admin,
     * it returns the view for the admin dashboard. Otherwise, it returns the view for the frontend main layout.
     *
     * @return \Illuminate\View\View
     */
    public function Admin_dashboard()
    {
        if (Auth()->user()->supper_admin == 1) {
            return view('admin.layouts.main');
        } else {
            return view('frontend.layouts.main');
        }
    }

    /**
     * Log the admin out.
     *
     * This method handles the logout process for the admin. It logs out the authenticated user using the Auth facade.
     * After logging out, it prepares a success notification and redirects the user to the admin login page with the notification.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function Admin_logout()
    {
        Auth::logout();
        $notification = array('messege' => 'Logout Successfully', 'alert-type' => 'success');
        return redirect()->route('admin_login')->with($notification);
    }





    /**
     * Update the password of the authenticated user.
     *
     * This method validates the request to ensure the old password is provided and that the new password meets the required criteria.
     * It checks if the provided old password matches the current user's password. If it does, the user's password is updated, and they are logged out to reauthenticate with the new password.
     * If the old password does not match, an error notification is returned.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password_change()
    {
        return view('admin.profile.change_password');
    }

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






    /**
     * Display the profile of the authenticated user.
     *
     * This method retrieves the currently authenticated user's profile information from the 'users' table and passes it to the 'main_profile' view.
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        $user_id = Auth::user()->id;

        $profile = DB::table('users')->where('id', $user_id)->first();
        return view('admin.profile.main_profile', compact('profile'));
    }




    /**
     * Update the profile of a specific user.
     *
     * This method updates the 'name' and 'phone' fields of a user's profile in the 'users' table based on the provided ID.
     * After the update, it redirects back to the 'main_profile' route with a success notification.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function Profile_Update(Request $request, $id)
    {
        // dd($request->all());
        $data = array();
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;

        DB::table('users')->where('id', $id)->update($data);

        $notification = array('messege' => 'Update Successfully !', 'alert-type' => 'success');
        return redirect()->route('main_profile')->with($notification);
    }
}
