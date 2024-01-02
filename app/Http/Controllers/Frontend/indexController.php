<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Categorie;
use App\Models\Product;
use App\Models\Review;

class indexController extends Controller
{
    //

    // root page
    public function home_page()
    {
        $category = Categorie::all();
        $product_slider = Product::where('product_slider', 1)->latest()->first();

        return view('frontend.layouts.main', compact('category', 'product_slider'));
        // return view('frontend.layouts.main');
    }

    // product details //
    public function product_details(Request $request)
    {
        $product_details = $request->slug;

        $product = Product::where('slug', $product_details)->first();
        // $view_product = Product::where('slug', $slug)->increment('product_views');
        $review = Review::orderBy('id', 'DESC')->limit(6)->get();
        $related_product = Product::where('subcategory_id', $product->subcategory_id)->orderBy('id', 'DESC')->limit(10)->get();
        // $featured = Product::where('status', 1)->orderBy('id', 'DESC')->limit(8)->get();
        // $popular_product = Product::where('status', 1)->orderBy('product_views', 'DESC')->limit(8)->get();
        return view('frontend.product.product_details', compact('product', 'related_product', 'review'));
    } // end 
}
