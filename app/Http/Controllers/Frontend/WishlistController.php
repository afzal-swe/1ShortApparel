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

    public function __construct()
    {
        $this->db_wishlist = 'wishlists';
    }

    public function add_wishlist($id)
    {

        $check = DB::table('wishlists')->where('product_id', $id)->where('user_id', Auth::id())->first();

        if ($check) {
            $notification = array('messege' => 'Already have it on your wishlist !', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        } else {
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

    public function wishlist_view()
    {

        if (Auth::check()) {

            $wishlist = DB::table($this->db_wishlist)
                ->leftJoin('products', 'wishlists.product_id', 'products.id')
                ->select('products.product_title', 'products.thumbnail', 'products.slug', 'wishlists.*')
                ->where('wishlists.user_id', Auth::id())->get();

            return view('frontend.wishlist.wishlist', compact('wishlist'));
        }
        $notification = array('messege' => 'Product add on wishlist !', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function wishlist_product_delete(Request $request)
    {


        DB::table($this->db_wishlist)
            ->where('id', $request->id)
            ->delete();


        $notification = array('messege' => 'Wishlist Removed Successfully !', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function clear_wishlist()
    {


        DB::table($this->db_wishlist)
            ->where('user_id', Auth::id())
            ->delete();

        $notification = array('messege' => 'Wishlist Clear Successfully !', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
