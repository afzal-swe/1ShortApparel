<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlists;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    //

    private $db_wishlist;



    /**
     * Create a new instance of the controller and initialize database table name.
     *
     * @return void
     */
    public function __construct()
    {
        // Initialize the database table name for wishlists.
        $this->db_wishlist = 'wishlists';
    }




    /**
     * Add a product to the user's wishlist.
     *
     * @param  int  $id  The ID of the product to be added to the wishlist.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add_wishlist($id)
    {
        // Check if the product is already in the user's wishlist.
        $check = DB::table('wishlists')->where('product_id', $id)->where('user_id', Auth::id())->first();

        if ($check) {
            // If the product is already in the wishlist, redirect back with an error notification.
            $notification = array('messege' => 'Already have it on your wishlist !', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        } else {
            // If the product is not in the wishlist, add it and redirect back with a success notification.
            Wishlists::insert([
                'user_id' => Auth::id(),
                'product_id' => $id,
                'date' => date('d, F Y'),
                'created_at' => Carbon::now(),
            ]);
            $notification = array('messege' => 'Product add on wishlist !', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    }





    /**
     * Display the user's wishlist.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function wishlist_view()
    {
        // Check if the user is authenticated.
        if (Auth::check()) {

            // Retrieve the user's wishlist items with product details.
            $wishlist = DB::table($this->db_wishlist)
                ->leftJoin('products', 'wishlists.product_id', 'products.id')
                ->select('products.product_title', 'products.thumbnail', 'products.slug', 'wishlists.*')
                ->where('wishlists.user_id', Auth::id())->get();

            // Return the wishlist view with the retrieved data.
            return view('frontend.wishlist.wishlist', compact('wishlist'));
        }

        // If the user is not authenticated, redirect back with a success notification.
        $notification = array('messege' => 'Product add on wishlist !', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }





    /**
     * Remove a product from the user's wishlist.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function wishlist_product_delete(Request $request)
    {
        // Delete the wishlist item with the specified ID.
        DB::table($this->db_wishlist)
            ->where('id', $request->id)
            ->delete();

        // Return redirect with a success notification.
        $notification = array('messege' => 'Wishlist Removed Successfully !', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }



    /**
     * Clear all items from the user's wishlist.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clear_wishlist()
    {
        // Delete all wishlist items for the authenticated user.
        DB::table($this->db_wishlist)
            ->where('user_id', Auth::id())
            ->delete();

        // Return redirect with a success notification.
        $notification = array('messege' => 'Wishlist Clear Successfully !', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
