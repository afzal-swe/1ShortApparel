<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;


class ReviewController extends Controller
{



    /**
     * Add a review for a specific product.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function review_add(Request $request)
    {
        $request->validate([
            'rating' => 'required',
            'review' => 'required',
        ]);

        $check = DB::table('reviews')->where('user_id', Auth::id())->where('product_id', $request->product_id)->first();

        if ($check) {
            $notification = array('messege' => 'Already you have a review', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        } else {
            Review::insert([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'review_date' => date('d-m-Y'),
                'review_year' => date('Y'),
                'review_month' => date('F'),
                'rating' => $request->rating,
                'review' => $request->review,
                'created_at' => Carbon::now(),
            ]);
            $notification = array('messege' => 'Thank for your Review', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    }
}
