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





    /**
     * Initialize the class with database table names.
     */
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
    /**
     * Display the home page with various product and campaign details.
     *
     * @return \Illuminate\View\View
     */
    public function home_page()
    {
        $category = Categorie::all(); // Retrieve all categories
        $product_slider = Product::where('product_slider', 1)->latest()->first(); // Retrieve the latest product for the slider
        $featured = Product::where('status', 1)->orderBy('id', 'DESC')->limit(16)->get(); // Retrieve the latest 16 featured products
        $trendy_product = Product::where('status', 1)->where('trendy', 1)->orderBy('id', 'DESC')->limit(8)->get(); // Retrieve the latest 8 trendy products
        $wbreview = DB::table($this->db_wbreview)->where('status', 1)->orderBy('id', 'DESC')->limit(12)->get(); // Retrieve the latest 12 reviews
        $campaingn = DB::table($this->campaingns)->where('status', 1)->orderBy('id', 'DESC')->first(); // Retrieve the latest campaign
        // dd($featured);
        return view('frontend.layouts.main', compact('category', 'product_slider', 'featured', 'trendy_product', 'wbreview', 'campaingn'));
    }




    /**
     * Display the details of a specific product.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function product_details(Request $request)
    {

        $product_details = $request->slug; // Get the product slug from the request

        $product = Product::where('slug', $product_details)->first(); // Retrieve the product by slug

        $view_product = Product::where('slug', $product_details)->increment('product_views'); // Increment the product view count
        $review = Review::orderBy('id', 'DESC')
            ->limit(6)
            ->get(); // Retrieve the latest 6 reviews
        $related_product = Product::where('subcategory_id', $product->subcategory_id)
            ->orderBy('id', 'DESC')
            ->limit(10)
            ->get(); // Retrieve the latest 10 products in the same subcategory
        $popular_product = Product::where('status', 1)
            ->orderBy('product_views', 'DESC')
            ->limit(8)
            ->get(); // Retrieve the 8 most popular products based on views

        // $share = Share::page(url()->current())
        //     ->facebook()
        //     ->twitter()
        //     ->linkedin('Extra linkedin summary can be passed here')
        //     ->whatsapp()
        //     ->getRawLinks();

        return view('frontend.product.product_details', compact('product', 'related_product', 'review', 'view_product', 'popular_product'));
    }





    /**
     * Display products categorized by a specific category.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function categorywise_product(Request $request)
    {
        // Retrieve the category by ID
        $category = DB::table($this->db_categories)
            ->where('id', $request->id)
            ->first();

        // Retrieve all subcategories under the specified category
        $subcategory = DB::table($this->db_subcategory)
            ->where('category_id', $request->id)
            ->get();

        // Retrieve all products under the specified category, paginated
        $products = DB::table($this->db_products)
            ->where('category_id', $request->id)
            ->paginate(20);

        // Return the view with the retrieved data
        return view('frontend.product.category_product', compact('category', 'subcategory', 'products'));
    }





    /**
     * Display products filtered by a specific subcategory.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function subcategorywise_product(Request $request)
    {
        // Retrieve the subcategory by ID
        $subcategory = DB::table($this->db_subcategory)
            ->where('id', $request->id)
            ->first();

        // Retrieve all subcategories under the same category as the specified subcategory
        $subcategorywise = DB::table($this->db_subcategory)
            ->where('category_id', $request->id)
            ->get();

        // Retrieve all products under the specified subcategory, paginated
        $products = DB::table($this->db_products)
            ->where('category_id', $request->id)
            ->paginate(20);

        // Return the view with the retrieved data
        return view('frontend.product.subcategory_product', compact('subcategory', 'products', 'subcategorywise'));
    }






    /**
     * Store a new email subscription for the newsletter.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeNewsletter(Request $request)
    {

        // Retrieve the email from the request
        $email = $request->email;

        // Check if the email already exists in the newsletter subscriptions
        $check = DB::table($this->db_NewsLetter)->where('email', $email)->first();

        if ($check) {
            $notification = array('messege' => 'Email Already Exist', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        } else {
            // Insert the new email into the newsletter subscriptions
            $data = array();
            $data['email'] = $request->email;
            DB::table($this->db_NewsLetter)->insert($data);

            // Return a success notification
            $notification = array('messege' => 'Thanks for subscribe us!', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    }





    /**
     * Show the order tracking page.
     *
     * @return \Illuminate\View\View
     */
    public function Order_Tracking()
    {
        return view('frontend.tracking.order_tracking');
    }







    /**
     * Check and display the details of an order based on the provided order ID.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
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






    /**
     * Retrieve and display products associated with a specific campaign.
     *
     * @param int $id Campaign ID
     * @return \Illuminate\View\View
     */
    public function Campaign_Products($id)
    {



        $products = DB::table($this->db_campaign_product)
            ->leftJoin('products', 'campaign_product.product_id', 'products.id')
            ->select('products.product_title', 'products.product_code', 'products.thumbnail', 'campaign_product.*')
            ->where('campaign_product.campaign_id', $id)
            ->get();

        // dd($products);
        return view('frontend.campaign.product_list', compact('products'));
    }






    /**
     * Retrieve and display details of a specific campaign product along with related products and reviews.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id Product ID
     * @return \Illuminate\View\View
     */
    public function Campaign_Product_Details(Request $request, $product_id)
    {

        $product = Product::where('id', $product_id)->first();
        // dd($product);

        $test = Product::where('id', $product_id)->increment('product_views');

        $product_price = DB::table($this->db_campaign_product)
            ->where('product_id', $product_id)
            ->first();

        $related_product = DB::table($this->db_campaign_product)->leftJoin('products', 'campaign_product.product_id', 'products.id')
            ->select('products.product_title', 'products.product_code', 'products.thumbnail', 'products.id', 'campaign_product.*')
            ->inRandomOrder(12)
            ->get();
        $review = Review::where('product_id', $product_id)
            ->orderBy('id', 'DESC')
            ->take(6)
            ->get();
        // dd($review);
        return view('frontend.campaign.product_details', compact('product', 'related_product', 'review', 'product_price'));
    }
}
