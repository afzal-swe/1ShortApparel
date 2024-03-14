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
        // dd($request->all());

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
}
