<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
// use Cart;

class CartController extends Controller
{
    //

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
}
