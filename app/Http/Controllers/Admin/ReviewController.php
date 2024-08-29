<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    //
    private $db_review;



    /**
     * Initialize the controller with database table names.
     *
     * This constructor sets the table name for user reviews.
     */
    public function __construct()
    {
        $this->db_review = "reviews";
    }





    /**
     * Retrieve and display user reviews from the database.
     *
     * This method retrieves user reviews along with associated user names and product titles by joining
     * the `reviews` table with the `users` and `products` tables. It then sorts the reviews in descending
     * order by ID and passes the data to the `admin.user_review.index` view.
     *
     * @return \Illuminate\View\View The view displaying the user reviews.
     */
    public function User_Review()
    {
        $review = DB::table($this->db_review)
            ->join('users', 'reviews.user_id', 'users.id')
            ->join('products', 'reviews.product_id', 'products.id')
            ->select('reviews.*', 'users.name', 'products.product_title')
            ->orderBy('id', 'DESC')->get();
        return view('admin.user_review.index', compact('review'));
    }




    /**
     * Delete the specified review from the database.
     *
     * This method handles the deletion of a review based on its ID.
     * After successfully deleting the review, it redirects to the user reviews page with a success notification.
     *
     * @param  int  $id  The ID of the review to delete.
     * @return \Illuminate\Http\RedirectResponse Redirects to the user reviews page with a success message.
     */
    public function Review_Delete($id)
    {

        DB::table($this->db_review)->where('id', $id)->delete();

        $notification = array('messege' => 'Review Delete !', 'alert-type' => 'success');
        return redirect()->route('user.review')->with($notification);
    }
}
