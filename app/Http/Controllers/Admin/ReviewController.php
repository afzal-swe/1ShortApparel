<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    //
    private $db_review;

    public function __construct()
    {
        $this->db_review = "reviews";
    }

    public function User_Review()
    {
        $review = DB::table($this->db_review)
            ->join('users', 'reviews.user_id', 'users.id')
            ->join('products', 'reviews.product_id', 'products.id')
            ->select('reviews.*', 'users.name', 'products.product_title')
            ->orderBy('id', 'DESC')->get();
        return view('admin.user_review.index', compact('review'));
    }

    // Review Delete Section
    public function Review_Delete($id)
    {

        DB::table($this->db_review)->where('id', $id)->delete();

        $notification = array('messege' => 'Review Delete !', 'alert-type' => 'success');
        return redirect()->route('user.review')->with($notification);
    }
}
