<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UserProfileController extends Controller
{
    //

    private $db_web_site_review;

    public function __construct()
    {
        $this->middleware('auth');
        $this->db_web_site_review = "wereviews";
    }

    public function user_info()
    {
        return view('user.profile');
    }
    public function deshboard()
    {
        return view('home');
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
}
