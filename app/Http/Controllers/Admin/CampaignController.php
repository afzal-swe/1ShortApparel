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






    /**
     * Constructor to initialize middleware and database table names.
     *
     * This method ensures that the `auth` middleware is applied to all routes
     * that use this controller, requiring user authentication. It also initializes
     * the names of the database tables used in the controller for campaigns, products,
     * and campaign products.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->db_campaingns = "campaingns";
        $this->db_products = "products";
        $this->db_campaign_product = "campaign_product";
    }








    /**
     * Display all campaigns with options for editing, deleting, and adding products.
     *
     * This method handles both AJAX requests and regular page loads.
     * If the request is AJAX, it fetches all campaigns from the database, formats
     * them into a DataTable, and returns the data as JSON. The DataTable includes
     * columns for campaign status and action buttons (edit, delete, and add product).
     * If the request is not AJAX, it returns the view for the campaign index page.
     *
     * @param Request $request The HTTP request object.
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View JSON response for AJAX requests or the campaign index view.
     */
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







    /**
     * Add a new campaign to the database.
     *
     * This method validates the request input, processes the campaign image, and 
     * inserts a new campaign record into the database. If the image is provided, it
     * is resized and saved to the specified directory. After successful insertion, 
     * a success notification is generated and the user is redirected back.
     *
     * @param Request $request The HTTP request object containing campaign details.
     * @return \Illuminate\Http\RedirectResponse Redirects back with a success notification.
     */
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








    /**
     * Display the form to edit an existing campaign.
     *
     * This method retrieves the campaign data by its ID and returns a view 
     * to edit the campaign details. The retrieved data is passed to the view 
     * using the `compact` function.
     *
     * @param int $id The ID of the campaign to be edited.
     * @return \Illuminate\View\View The view to edit the campaign details.
     */
    public function campaign_edit($id)
    {
        $data = Campaingn::find($id);
        return view('admin.offer.campaign.edit', compact('data'));
    }







    /**
     * Update an existing campaign with new data.
     *
     * This method updates the campaign data with the given input. If a new image is uploaded,
     * it deletes the old image, processes the new image, and updates the campaign record with the new image path.
     * Otherwise, it updates the campaign without changing the image.
     *
     * @param \Illuminate\Http\Request $request The incoming request with the campaign data.
     * @return \Illuminate\Http\RedirectResponse Redirects to the list of all campaigns with a success notification.
     */
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







    /**
     * Delete a campaign and its associated image from the storage.
     *
     * This method deletes a campaign record from the database. If the campaign has an associated image,
     * it checks if the image file exists and deletes it before removing the campaign record.
     *
     * @param int $id The ID of the campaign to be deleted.
     * @return \Illuminate\Http\RedirectResponse Redirects back with a success notification.
     */
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








    /**
     * Display the products for a specific campaign.
     *
     * This method retrieves all products along with their associated categories, subcategories, and brands
     * that are currently active. It then returns a view with the list of products and the campaign ID.
     *
     * @param int $campaign_id The ID of the campaign for which products are to be displayed.
     * @return \Illuminate\View\View The view displaying the products for the given campaign.
     */
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







    /**
     * Add a product to a specific campaign with a discounted price.
     *
     * This method calculates the discounted price for a product based on the campaign's discount,
     * and then associates the product with the campaign by inserting the details into the campaign-product table.
     *
     * @param int $id The ID of the product to be added to the campaign.
     * @param int $campaign_id The ID of the campaign to which the product is to be added.
     * @return \Illuminate\Http\RedirectResponse Redirects back with a success notification.
     */
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








    /**
     * Display the list of products associated with a specific campaign.
     *
     * This method retrieves all products linked to the given campaign ID and prepares them for display
     * along with the campaign details.
     *
     * @param int $campaign_id The ID of the campaign for which products are to be listed.
     * @return \Illuminate\View\View Returns a view with the list of products and campaign details.
     */
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






    /**
     * Remove a product from a campaign.
     *
     * This method deletes the association of a product with a campaign based on the provided ID.
     *
     * @param int $id The ID of the product-campaign association to be removed.
     * @return \Illuminate\Http\RedirectResponse Redirects back with a success notification.
     */
    public function RemoveProduct($id)
    {

        DB::table($this->db_campaign_product)->where('id', $id)->delete();
        $notification = array('messege' => 'Product remove from campaign!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
