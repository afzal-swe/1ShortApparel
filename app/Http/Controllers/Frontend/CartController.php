<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
// use Cart;

class CartController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addToCart(Request $request)
    {

        $product = Product::where('id', $request->id)->first();
        // dd($product);
        // $user_id = Auth::user()->id;

        $data = Cart::add([
            'id' => $product->id,
            'name' => $product->product_title,
            'price' => $request->price,
            'qty' => $request->quantity_input,
            'weight' => '1',
            'options' => ['size' => $request->size, 'color' => $request->color, 'thumbnail' => $product->thumbnail]
        ]);

        $notification = array('messege' => 'Add To Cart Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);

        // return response()->json($data);
    }

    public function my_cart()
    {

        $content = Cart::content();

        return view('frontend.cart.cart', compact('content'));
    }

    // single cart delete this function
    public function cart_product_remove(Request $request)
    {
        Cart::remove($request->rowId);

        $notification = array('messege' => 'Cart Remove Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    // all cart delete this function
    public function cart_destory()
    {
        Cart::destroy();
        $notification = array('messege' => 'Cart item Clear!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function checkout()
    {

        if (!Auth::check()) {
            $notification = array('messege' => 'Login Your Account', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }

        $content = Cart::content();
        return view('frontend.cart.checkout', compact('content'));
    }

    //__ Apply Coupon __
    public function applyCoupon(Request $request)
    {
        // dd($request->all());

        $check = DB::table('coupons')->where('coupon_code', $request->coupon)->first();

        if ($check) {

            //__coupon exist
            if (date('Y-m-d', strtotime(date('Y-m-d'))) <= date('Y-m-d', strtotime($check->valid_date))) {
                session::put('coupon', [
                    'name' => $check->coupon_code,
                    'discount' => $check->coupon_amount,
                    'after_discount' => Cart::subtotal() - $check->coupon_amount,
                ]);
                $notification = array('messege' => 'Coupon Applied!', 'alert-type' => 'success');
                return redirect()->back()->with($notification);
            } else {
                $notification = array('messege' => 'Expired Coupon Code!', 'alert-type' => 'error');
                return redirect()->back()->with($notification);
            }
        } else {
            $notification = array('messege' => 'Invalid Coupon Code! Try Again.', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }

    public function couponRemove()
    {
        Session::forget('coupon');
        $notification = array('messege' => 'Coupon Removed!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
