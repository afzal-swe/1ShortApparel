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
                'created_at' => Carbon::now(),
            ]);
            $notification = array('messege' => 'Product add on wishlist !', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    }
}
