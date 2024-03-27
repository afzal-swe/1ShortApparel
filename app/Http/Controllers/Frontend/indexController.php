<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Categorie;
use App\Models\Product;
use App\Models\Review;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;

class indexController extends Controller
{
    //
    private $db_categories;
    private $db_subcategory;
    private $db_products;
    private $db_wbreview;

    public function __construct()
    {
        $this->db_categories = "categories";
        $this->db_subcategory = "sub_categories";
        $this->db_products = "products";
        $this->db_wbreview = "wereviews";
    }

    // root page
    public function home_page()
    {
        $category = Categorie::all();
        $product_slider = Product::where('product_slider', 1)->latest()->first();
        $featured = Product::where('status', 1)->orderBy('id', 'DESC')->limit(16)->get();
        $trendy_product = Product::where('status', 1)->where('trendy', 1)->orderBy('id', 'DESC')->limit(8)->get();
        $wbreview = DB::table($this->db_wbreview)->where('status', 1)->orderBy('id', 'DESC')->limit(12)->get();
        return view('frontend.layouts.main', compact('category', 'product_slider', 'featured', 'trendy_product', 'wbreview'));
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

    public function categorywise_product(Request $request)
    {
        // dd($request->id);
        $category = DB::table($this->db_categories)
            ->where('id', $request->id)
            ->first();

        $subcategory = DB::table($this->db_subcategory)
            ->where('category_id', $request->id)
            ->get();

        $products = DB::table($this->db_products)
            ->where('category_id', $request->id)
            ->paginate(20);

        return view('frontend.product.category_product', compact('category', 'subcategory', 'products'));
    }

    public function subcategorywise_product(Request $request)
    {
        $subcategory = DB::table($this->db_subcategory)
            ->where('id', $request->id)
            ->first();

        $subcategorywise = DB::table($this->db_subcategory)
            ->where('category_id', $request->id)
            ->get();

        $products = DB::table($this->db_products)
            ->where('category_id', $request->id)
            ->paginate(20);

        return view('frontend.product.subcategory_product', compact('subcategory', 'products', 'subcategorywise'));
    }
}
