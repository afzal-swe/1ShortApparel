<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\Models\Campaingn;
use Yajra\DataTables\Facades\DataTables;

class CampaignController extends Controller
{
    //
    private $db_campaingns;
    private $db_products;
    private $db_campaign_product;

    public function __construct()
    {
        $this->middleware('auth');
        $this->db_campaingns = "campaingns";
        $this->db_products = "products";
        $this->db_campaign_product = "campaign_product";
    }

    public function all_campaign(Request $request)
    {

        if ($request->ajax()) {
            $data = DB::table($this->db_campaingns)->orderBy('id', 'DESC')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return '<a href="#"><span class="badge badge-success">Active</span> </a>';
                    } else {
                        return '<a href="#"><span class="badge badge-danger">Inactive</span> </a>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionbtn = '<a href="#" class="btn btn-info btn-sm edit" data-id="' . $row->id . '" data-toggle="modal" data-target="#editModal" ><i class="fas fa-edit"></i></a>

                        <a href="' . route('campaign.delete', [$row->id]) . '" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i>
                        </a>
                        <a href="' . route('campaign.product', [$row->id]) . '" class="btn btn-success btn-sm"><i class="fas fa-plus"></i>
                        </a>';
                    return $actionbtn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('admin.offer.campaign.index');
    }



    public function campaign_add(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:campaingns|max:50',
            'image' => 'required',
        ]);

        if ($request->file('image')) {

            $name = Str::of($request->title)->slug('-');

            $img = $request->file('image');
            $name_gen = $name . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(468, 90)->save("image/campaign/" . $name_gen);
            $save_img = "image/campaign/" . $name_gen;

            Campaingn::insert([
                'title' => $request->title ?? "Null",
                'start_date' => $request->start_date ?? "Null",
                'end_date' => $request->end_date ?? "Null",
                'discount' => $request->discount ?? "Null",
                'slug' => $name ?? "Null",
                'image' => $save_img ?? "Null",
                'month' => date('F'),
                'year' => date('Y'),
                'status' => $request->status ?? "Null",
                'created_at' => Carbon::now(),

            ]);
            $notification = array('messege' => 'Campaign Create Successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    }



    // Edit Campaign Function
    public function campaign_edit($id)
    {
        $data = Campaingn::find($id);
        return view('admin.offer.campaign.edit', compact('data'));
    }


    public function campaign_update(Request $request)
    {
        $update = $request->id;
        $file = Campaingn::findOrFail($update);

        if ($request->file('image')) {

            $img = $file->image;
            unlink($img);

            $name = Str::of($request->title)->slug('-');

            $img = $request->file('image');

            $name_gen = $name . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(468, 90)->save("image/campaign/" . $name_gen);
            $save_img = "image/campaign/" . $name_gen;

            Campaingn::findOrFail($update)->update([
                'title' => $request->title ?? "Null",
                'start_date' => $request->start_date ?? "Null",
                'end_date' => $request->end_date ?? "Null",
                'discount' => $request->discount ?? "Null",
                'slug' => $name ?? "Null",
                'image' => $save_img ?? "Null",
                'month' => date('F'),
                'year' => date('Y'),
                'status' => $request->status ?? "Null",
                'image' => $save_img,
                'updated_at' => Carbon::now(),

            ]);
            $notification = array('messege' => 'Campaingn Update Successfully', 'alert-type' => 'success');
            return redirect()->route('campaign.all_campaign')->with($notification);
        } else {
            Campaingn::findOrFail($update)->update([
                'title' => $request->title ?? "Null",
                'start_date' => $request->start_date ?? "Null",
                'end_date' => $request->end_date ?? "Null",
                'discount' => $request->discount ?? "Null",
                'slug' => $name ?? "Null",
                'image' => $save_img ?? "Null",
                'month' => date('F'),
                'year' => date('Y'),
                'status' => $request->status ?? "Null",
                'updated_at' => Carbon::now(),
            ]);
            $notification = array('messege' => 'Brand Update Successfully', 'alert-type' => 'success');
            return redirect()->route('campaign.all_campaign')->with($notification);
        }
    }

    public function campaign_delete($id)
    {
        $campaign = Campaingn::findOrFail($id);

        if ($campaign->image) {
            // Get the image path
            $img = $campaign->image;

            // Check if the file exists before attempting to delete it
            if (file_exists($img)) {
                unlink($img); // Delete the image file
            }
        }

        // Delete the campaign record from the database
        $campaign->delete();

        // Set notification message
        $notification = array('message' => 'Campaign deleted successfully', 'alert-type' => 'success');

        // Redirect back with notification
        return redirect()->back()->with($notification);
    }


    // Campagin Product
    public function Campaign_Product($campaign_id)
    {
        $products = DB::table($this->db_products)->leftJoin('categories', 'products.category_id', 'categories.id')
            ->leftJoin('sub_categories', 'products.subcategory_id', 'sub_categories.id')
            ->leftJoin('brands', 'products.brand_id', 'brands.id')
            ->select('products.*', 'categories.category_name', 'sub_categories.subcategory_name', 'brands.name')
            ->where('products.status', '1')
            ->get();

        // dd($products);
        return view('admin.offer.campaign_product.index', compact('products', 'campaign_id'));
    }

    // Add Product To Campaign
    public function ProductAddToCampaign($id, $campaign_id)
    {
        $campaign = DB::table($this->db_campaingns)->where('id', $campaign_id)->first();
        $product = DB::table($this->db_products)->where('id', $id)->first();

        $discount_amount = $product->product_price / 100 * $campaign->discount;
        $discount_price = $product->product_price - $discount_amount;
        // dd($discount_price);

        $data = array();
        $data['product_id'] = $id;
        $data['campaign_id'] = $campaign_id;
        $data['price'] = $discount_price;
        DB::table($this->db_campaign_product)->insert($data);
        $notification = array('messege' => 'Product added to campaign!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    // Campaign Product List
    public function ProductListCampaign($campaign_id)
    {
        $products = DB::table($this->db_campaign_product)->leftJoin('products', 'campaign_product.product_id', 'products.id')
            ->select('products.product_title', 'products.product_code', 'products.thumbnail', 'campaign_product.*')
            ->where('campaign_product.campaign_id', $campaign_id)
            ->get();

        // dd($products);
        $campaign = DB::table($this->db_campaingns)->where('id', $campaign_id)->first();
        return view('admin.offer.campaign_product.campaign_product_list', compact('products', 'campaign'));
    }

    public function RemoveProduct($id)
    {

        DB::table($this->db_campaign_product)->where('id', $id)->delete();
        $notification = array('messege' => 'Product remove from campaign!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
