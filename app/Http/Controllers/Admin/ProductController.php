<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Brand;
use App\Models\Categorie;
use App\Models\Pickup_point;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Warehouse;


class ProductController extends Controller
{




    /**
     * Create a new instance of the controller.
     *
     * This constructor applies the 'auth' middleware to ensure that the user is authenticated.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }






    /**
     * Display a list of all products.
     *
     * This method retrieves all products from the 'products' table, ordered by ID in descending order, and returns
     * the view for displaying the list of products.
     *
     * @return \Illuminate\View\View
     */
    public function all_product()
    {
        $product = Product::orderBy('id', 'DESC')->get();
        return view('admin.product.index', compact('product'));
    }








    /**
     * Display the form for adding a new product.
     *
     * This method retrieves all active brands, categories, subcategories, pickup points, and warehouses,
     * and returns the view for creating a new product with these data points.
     *
     * @return \Illuminate\View\View
     */
    public function product_add()
    {
        $brand = Brand::where('status', '=', "1")
            ->get();

        $category = Categorie::where('category_status', '=', '1')
            ->get();

        $subcategory = SubCategory::where('subcategory_status', '=', '1')
            ->get();

        $pickup_point = Pickup_point::all();
        $warehouse = Warehouse::all();

        return view('admin.product.create', compact('brand', 'category', 'subcategory', 'pickup_point', 'warehouse'));
    }


    public function product_store(Request $request)
    {
        // dd($request->all());
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
            'images' => 'required',
            'thumbnail' => 'required',
        ], [
            'brand_id.required' => 'This brand name is required',
            'subcategory_id.required' => 'This category is required',
            'product_title.required' => 'This product name is required',
            'product_code.required' => 'This product code is required',
            'product_unit.required' => 'This product unit is required',
            'product_price.required' => 'This product price is required',
            'product_purchase_price.required' => 'This product purchase price is required',
            'warehouse.required' => 'This warehouse is required',
            'images.required' => 'This image is required',
            'thumbnail.required' => 'This thumbnail is required',
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
    }

    // public function product_store(Request $request)
    // {


    //     $request->validate([
    //         'brand_id' => 'required',
    //         // 'category_id' => 'required',
    //         'subcategory_id' => 'required',
    //         'product_title' => 'required',
    //         'product_code' => 'required|unique:products|max:50',
    //         'product_unit' => 'required',
    //         'product_price' => 'required',
    //         'product_purchase_price' => 'required',
    //         'warehouse' => 'required',
    //     ]);

    //     // subcategory call for category id
    //     $subcategory = DB::table('sub_categories')->where('id', $request->subcategory_id)->first();
    //     // $subcategory->category_id;

    //     $slug = Str::of($request->product_title)->slug('-');

    //     $data = array();
    //     $data['product_title'] = $request->product_title;
    //     $data['product_code'] = $request->product_code;
    //     $data['brand_id'] = $request->brand_id;
    //     $data['category_id'] = $subcategory->category_id;
    //     $data['subcategory_id'] = $request->subcategory_id;
    //     $data['pickup_point'] = $request->pickup_point;
    //     $data['product_unit'] = $request->product_unit;
    //     $data['product_tags'] = $request->product_tags;
    //     $data['product_price'] = $request->product_price;
    //     $data['product_purchase_price'] = $request->product_purchase_price;
    //     $data['discount_price'] = $request->discount_price;
    //     $data['warehouse'] = $request->warehouse;
    //     $data['stock_quantity'] = $request->stock_quantity;
    //     $data['product_color'] = $request->product_color;
    //     $data['product_size'] = $request->product_size;
    //     $data['product_description'] = $request->product_description;
    //     $data['product_video'] = $request->product_video;
    //     $data['admin_id'] = Auth::id();
    //     $data['post_date'] = date('d-m-Y');
    //     $data['post_month'] = date('F');
    //     $data['slug'] = $slug;
    //     $data['created_at'] = Carbon::now();
    //     $data['featured'] = $request->featured;
    //     $data['hot_new_arrivals'] = $request->hot_new_arrivals;
    //     $data['today_deal'] = $request->today_deal;
    //     $data['hot_best_sellers'] = $request->hot_best_sellers;
    //     $data['flash_deal_id'] = $request->flash_deal_id;
    //     $data['cash_on_delivery'] = $request->cash_on_delivery;
    //     $data['status'] = $request->status;
    //     $data['product_slider'] = $request->product_slider;
    //     $data['trendy'] = $request->trendy;

    //     //single thumbnail
    //     if ($request->thumbnail) {
    //         $thumbnail = $request->thumbnail;
    //         $photoname = $slug . '.' . $thumbnail->getClientOriginalExtension();
    //         Image::make($thumbnail)->resize(600, 600)->save('image/product/thumbnail/' . $photoname);
    //         $data['thumbnail'] = $photoname;   // public/files/product/plus-point.jpg
    //     }

    //     //multiple images
    //     $images = array();
    //     if ($request->hasFile('images')) {
    //         foreach ($request->file('images') as $key => $image) {
    //             $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
    //             Image::make($image)->resize(115, 115)->save('image/product/images/' . $imageName);
    //             array_push($images, $imageName);
    //         }
    //         $data['images'] = json_encode($images);
    //     }
    //     DB::table('products')->insert($data);
    //     $notification = array('messege' => 'New Product Added Successfully', 'alert-type' => 'success');
    //     return redirect()->route('product.all_product')->with($notification);
    // } // End Product insert function //

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

        $slug = Str::of($request->product_title)->slug('-');

        $data = array();
        $data['product_title'] = $request->product_title;
        $data['product_code'] = $request->product_code;
        $data['brand_id'] = $request->brand_id;
        $data['category_id'] = $subcategory->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['pickup_point'] = $request->pickup_point;
        $data['product_unit'] = $request->product_unit;
        $data['product_tags'] = $request->product_tags;
        $data['product_price'] = $request->product_price;
        $data['product_purchase_price'] = $request->product_purchase_price;
        $data['discount_price'] = $request->discount_price;
        $data['warehouse'] = $request->warehouse;
        $data['stock_quantity'] = $request->stock_quantity;
        $data['product_color'] = $request->product_color;
        $data['product_size'] = $request->product_size;
        $data['product_description'] = $request->product_description;
        $data['product_video'] = $request->product_video;
        $data['admin_id'] = Auth::id();
        $data['post_date'] = date('d-m-Y');
        $data['post_month'] = date('F');
        $data['slug'] = $slug;
        $data['created_at'] = Carbon::now();
        $data['featured'] = $request->featured;
        $data['hot_new_arrivals'] = $request->hot_new_arrivals;
        $data['today_deal'] = $request->today_deal;
        $data['hot_best_sellers'] = $request->hot_best_sellers;
        $data['flash_deal_id'] = $request->flash_deal_id;
        $data['cash_on_delivery'] = $request->cash_on_delivery;
        $data['status'] = $request->status;
        $data['product_slider'] = $request->product_slider;
        $data['trendy'] = $request->trendy;




        //__old thumbnail ase kina__ jodi thake new thumbnail insert korte hobe
        $thumbnail = $request->file('thumbnail');
        if ($thumbnail) {

            $thumbnail = $request->thumbnail;
            $photoname = $slug . '.' . $thumbnail->getClientOriginalExtension();
            Image::make($thumbnail)->resize(600, 600)->save('image/product/thumbnail/' . $photoname);
            $data['thumbnail'] = $photoname;   // public/files/product/plus-point.jpg   
        }

        //__multiple image update__//

        $old_images = $request->has('old_images');
        if ($old_images) {
            $images = $request->old_images;
            $data['images'] = json_encode($images);
        } else {
            $images = array();
            $data['images'] = json_encode($images);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(600, 600)->save('image/product/images/' . $imageName);
                array_push($images, $imageName);
            }
            $data['images'] = json_encode($images);
        }



        DB::table('products')->where('id', $request->id)->update($data);
        $notification = array('messege' => 'Product Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function Product_delete($id)
    {
        $product = DB::table('products')->where('id', $id)->first();  //product data get
        if (File::exists('image/product/thumbnail/' . $product->thumbnail)) {
            FIle::delete('image/product/thumbnail/' . $product->thumbnail);
        }

        $images = json_decode($product->images, true);
        if (isset($images)) {
            foreach ($images as $key => $image) {
                if (File::exists('image/product/images/' . $image)) {
                    FIle::delete('image/product/images/' . $image);
                }
            }
        }

        DB::table('products')->where('id', $id)->delete();
        $notification = array('messege' => 'Product Deleted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    // Single Product Function
    public function Single_Product_View($id)
    {

        $product_details = DB::table('products')->where('id', $id)->first();
        return view('admin.product.single_product', compact('product_details'));
    }
}
