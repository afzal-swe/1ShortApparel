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
// use Jorenvh\Share\Share;

class indexController extends Controller
{
    //
    private $db_categories;
    private $db_subcategory;
    private $db_products;
    private $db_wbreview;
    private $db_NewsLetter;
    private $db_order;
    private $db_order_details;
    private $campaingns;
    private $db_campaign_product;

    public function __construct()
    {
        $this->db_categories = "categories";
        $this->db_subcategory = "sub_categories";
        $this->db_products = "products";
        $this->db_wbreview = "wereviews";
        $this->db_NewsLetter = "news_letters";
        $this->db_order = "orders";
        $this->db_order_details = "order__details";
        $this->campaingns = "campaingns";
        $this->db_campaign_product = "campaign_product";
    }

    // root page
    public function home_page()
    {
        $category = Categorie::all();
        $product_slider = Product::where('product_slider', 1)->latest()->first();
        $featured = Product::where('status', 1)->orderBy('id', 'DESC')->limit(16)->get();
        $trendy_product = Product::where('status', 1)->where('trendy', 1)->orderBy('id', 'DESC')->limit(8)->get();
        $wbreview = DB::table($this->db_wbreview)->where('status', 1)->orderBy('id', 'DESC')->limit(12)->get();
        $campaingn = DB::table($this->campaingns)->where('status', 1)->orderBy('id', 'DESC')->first();
        return view('frontend.layouts.main', compact('category', 'product_slider', 'featured', 'trendy_product', 'wbreview', 'campaingn'));
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




        // $share = /Share::page(url()->current())
        //     ->facebook()
        //     ->twitter()
        //     ->linkedin('Extra linkedin summary can be passed here')
        //     ->whatsapp()
        //     ->getRawLinks();




        return view('frontend.product.product_details', compact('product', 'related_product', 'review', 'view_product', 'popular_product', 'share'));
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

    // store news letter function //

    public function storeNewsletter(Request $request)
    {

        $email = $request->email;

        $check = DB::table($this->db_NewsLetter)->where('email', $email)->first();

        if ($check) {
            $notification = array('messege' => 'Email Already Exist', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        } else {
            $data = array();
            $data['email'] = $request->email;
            DB::table($this->db_NewsLetter)->insert($data);

            $notification = array('messege' => 'Thanks for subscribe us!', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    }

    // Order Tracking Page
    public function Order_Tracking()
    {
        return view('frontend.tracking.order_tracking');
    }

    // prder tracking check
    public function Check_Order(Request $request)
    {

        $check = DB::table($this->db_order)->where('order_id', $request->order_id)->first();
        // dd($check);
        if ($check) {
            $order = DB::table($this->db_order)->where('order_id', $request->order_id)->first();
            $order_details = DB::table($this->db_order_details)->where('order_id', $order->id)->get();
            return view('frontend.tracking.order_details', compact('order', 'order_details'));
        } else {
            $notification = array('messege' => 'Invalid OrderID! Try again.', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }

    // __ Campaign Product function
    public function Campaign_Products($id)
    {

        $products = DB::table($this->db_campaign_product)->leftJoin('products', 'campaign_product.product_id', 'products.id')
            ->select('products.product_title', 'products.product_code', 'products.thumbnail', 'campaign_product.*')
            ->where('campaign_product.campaign_id', $id)
            ->get();

        // dd($products);
        return view('frontend.campaign.product_list', compact('products'));
    }
}
