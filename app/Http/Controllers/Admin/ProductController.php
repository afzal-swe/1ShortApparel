<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Brand;
use App\Models\Categorie;
use App\Models\Pickup_point;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Warehouse;


class ProductController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    } // End // 

    // View All Product Section //
    public function all_product()
    {
        $product = Product::orderBy('id', 'DESC')->get();
        return view('admin.product.index', compact('product'));
    } // End //

    // New Product add form section //
    public function product_add()
    {
        $brand = Brand::where('status', '=', "1")->get();
        $category = Categorie::where('category_status', '=', '1')->get();
        $subcategory = SubCategory::where('subcategory_status', '=', '1')->get();
        $pickup_point = Pickup_point::all();
        $warehouse = Warehouse::all();


        return view('admin.product.create', compact('brand', 'category', 'subcategory', 'pickup_point', 'warehouse'));
    } // End //


    public function product_store(Request $request)
    {


        $request->validate([
            'brand_id' => 'required',
            // 'category_id' => 'required',
            'subcategory_id' => 'required',
            'product_title' => 'required',
            'product_code' => 'required|unique:products|max:50',
            'product_unit' => 'required',
            'product_price' => 'required',
            'product_purchase_price' => 'required',
            'warehouse' => 'required',
        ]);

        // subcategory call for category id
        $subcategory = DB::table('sub_categories')->where('id', $request->subcategory_id)->first();
        // $subcategory->category_id;

        $name_slug = Str::of($request->product_title)->slug('-');

        if ($request->file('thumbnail') || $request->file('images')) {

            $img = $request->file('images');
            $thumbnail = $request->file('thumbnail');


            $name_gen = $name_slug . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(115, 115)->save("image/product/images/" . $name_gen);
            $img_url = "image/product/images/" . $name_gen;


            $name_gen = $name_slug . '.' . $thumbnail->getClientOriginalExtension();
            Image::make($thumbnail)->resize(600, 600)->save("image/product/thumbnail/" . $name_gen);
            $thumbnail_url = "image/product/thumbnail/" . $name_gen;



            Product::insert([
                'product_title' => $request->product_title,
                'product_code' => $request->product_code,
                'brand_id' => $request->brand_id,
                'category_id' => $subcategory->category_id,
                'subcategory_id' => $request->subcategory_id,
                'pickup_point' => $request->pickup_point,
                'product_unit' => $request->product_unit,
                'product_tags' => $request->product_tags,
                'product_price' => $request->product_price,
                'product_purchase_price' => $request->product_purchase_price,
                'discount_price' => $request->discount_price,
                'warehouse' => $request->warehouse,
                'stock_quantity' => $request->stock_quantity,
                'product_color' => $request->product_color,
                'product_size' => $request->product_size,
                'product_description' => $request->product_description,
                'product_video' => $request->product_video,
                'admin_id' => Auth::id(),
                'post_date' => date('d-m-Y'),
                'post_month' => date('F'),
                'slug' => $name_slug,
                'created_at' => Carbon::now(),
                'thumbnail' => $thumbnail_url,
                'images' => $img_url,

                'featured' => $request->featured,
                'today_deal' => $request->today_deal,
                'hot_new_arrivals' => $request->hot_new_arrivals,
                'hot_best_sellers' => $request->hot_best_sellers,
                'flash_deal_id' => $request->flash_deal_id,
                'cash_on_delivery' => $request->cash_on_delivery,
                'status' => $request->status,
                'product_slider' => $request->product_slider,
                'trendy' => $request->trendy,

            ]);
            $notification = array('messege' => 'New Product Added Successfully', 'alert-type' => 'success');
            return redirect()->route('product.all_product')->with($notification);
        }
    } // End Product insert function //

    public function product_edit(Request $request)
    {

        $edit_product = $request->id;

        if ($edit_product !== Null) {
            $product_edit = Product::findOrFail($edit_product);

            $brand = Brand::where('status', '=', "1")->get();
            $category = Categorie::where('category_status', '=', '1')->get();
            $subcategory = SubCategory::where('subcategory_status', '=', '1')->get();
            $pickup_point = Pickup_point::all();
            $warehouse = Warehouse::all();
            return view('admin.product.edit', compact('product_edit', 'category', 'subcategory', 'pickup_point', 'warehouse', 'brand'));
        } else {
            echo "Page Not Found !";
        }
    }

    // product update 
    public function product_update(Request $request)
    {
        $product_update = $request->id;
        echo "update";
    }
}
