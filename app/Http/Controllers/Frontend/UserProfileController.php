<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    //

    private $db_tableuser;
    private $db_web_site_review;
    private $db_order;
    private $db_order_details;

    public function __construct()
    {
        $this->middleware('auth');
        $this->db_web_site_review = "wereviews";
        $this->db_tableuser = "users";
        $this->db_order = "orders";
        $this->db_order_details = "order__details";
    }

    public function deshboard()
    {
        $orders = DB::table($this->db_order)->where('user_id', Auth::id())->orderBy('id', 'DESC')->take(10)->get();
        //total order
        $total_order = DB::table('orders')->where('user_id', Auth::id())->count();
        $complete_order = DB::table('orders')->where('user_id', Auth::id())->where('status', 3)->count();
        $cancel_order = DB::table('orders')->where('user_id', Auth::id())->where('status', 5)->count();
        $return_order = DB::table('orders')->where('user_id', Auth::id())->where('status', 4)->count();



        return view('home', compact('orders', 'total_order', 'complete_order', 'cancel_order', 'return_order'));
    }

    public function user_info()
    {
        return view('user.profile');
    }

    public function userInfo_Update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|unique:users|max:50',
        ]);

        User::findOrFail($request->id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array('messege' => 'Save Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    //wqrite a review for website
    public function write_userReview()
    {
        return view('user.review_write');
    }

    public function store_websiteReview(Request $request)
    {
        $check = DB::table($this->db_web_site_review)->where('user_id', Auth::id())->first();
        if ($check) {
            $notification = array('messege' => 'Review already exist !', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }

        $data = array();
        $data['user_id'] = Auth::id();
        $data['name'] = $request->name;
        $data['review'] = $request->review;
        $data['rating'] = $request->rating;
        $data['review_date'] = date('d , F Y');
        $data['status'] = 0;
        $data['created_at'] = Carbon::now();
        DB::table($this->db_web_site_review)->insert($data);
        $notification = array('messege' => 'Thank for your review !', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    // Setting
    public function User_Setting()
    {

        return view('user.setting');
    }

    public function customer_PasswordChange(Request $request)
    {

        // dd($request->all());
        $validated = $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $current_password = Auth::user()->password;  //login user password get


        $oldpass = $request->old_password;  //oldpassword get from input field
        $new_password = $request->password;  // newpassword get for new password
        if (Hash::check($oldpass, $current_password)) {  //checking oldpassword and currentuser password same or not
            $user = User::findorfail(Auth::id());    //current user data get
            $user->password = Hash::make($request->password); //current user password hasing
            $user->save();  //finally save the password
            Auth::logout();  //logout the admin user anmd redirect admin login panel not user login panel
            $notification = array('messege' => 'Your Password Changed!', 'alert-type' => 'success');
            return redirect()->to('/')->with($notification);
        } else {
            $notification = array('messege' => 'Old Password Not Matched!', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }
}
