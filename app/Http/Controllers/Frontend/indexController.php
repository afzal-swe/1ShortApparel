<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Categorie;
use App\Models\Product;
use App\Models\Review;
use App\Models\Brand;

class indexController extends Controller
{
    //

    // root page
    public function home_page()
    {
        $category = Categorie::all();
        $product_slider = Product::where('product_slider', 1)->latest()->first();
        $featured = Product::where('status', 1)->orderBy('id', 'DESC')->limit(16)->get();
        $trendy_product = Product::where('status', 1)->where('trendy', 1)->orderBy('id', 'DESC')->limit(8)->get();
        return view('frontend.layouts.main', compact('category', 'product_slider', 'featured', 'trendy_product'));
    }

    // product details //
    public function product_details(Request $request)
    {
        $product_details = $request->slug;

        $product = Product::where('slug', $product_details)->first();
        $view_product = Product::where('slug', $product_details)->increment('product_views');
        $review = Review::orderBy('id', 'DESC')->limit(6)->get();
        $related_product = Product::where('subcategory_id', $product->subcategory_id)->orderBy('id', 'DESC')->limit(10)->get();
        $popular_product = Product::where('status', 1)->orderBy('product_views', 'DESC')->limit(8)->get();
        return view('frontend.product.product_details', compact('product', 'related_product', 'review', 'view_product', 'popular_product'));
    } // end 
}
