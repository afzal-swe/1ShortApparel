<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Categorie;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{

    private $db_sub_category;



    /**
     * Constructor for initializing the controller.
     *
     * This method sets up middleware for the controller. The middleware ensures that
     * the routes and actions in this controller require authentication. Only authenticated
     * users can access the methods in this controller.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->db_sub_category = "sub_categories";
    }



    /**
     * Display a listing of all subcategories along with brands and categories.
     *
     * This method retrieves all brands, categories, and subcategories from the database.
     * It then passes this data to the view for displaying a list of subcategories.
     * The subcategories are ordered by their ID in descending order.
     *
     * @return \Illuminate\View\View Returns the view 'admin.subcategory.index' with the
     *                                  subcategories, brands, and categories data.
     */
    public function All_subcategorys()
    {
        $brand = Brand::all();
        $category = Categorie::all();
        $sub_category = SubCategory::orderBy('id', 'DESC')->get();
        return view('admin.subcategory.index', compact('sub_category', 'brand', 'category'));
    }





    /**
     * Store a new subcategory in the database.
     *
     * This method handles the request to add a new subcategory. It validates the
     * required fields, processes the uploaded image, and saves the subcategory details
     * into the database. After successfully adding the subcategory, it redirects back
     * with a success notification.
     *
     * @param  \Illuminate\Http\Request  $request  The request object containing input data.
     * @return \Illuminate\Http\RedirectResponse Redirects back with a success message.
     */
    public function Add_subcategory(Request $request)
    {
        $validate = $request->validate([
            'brand_id' => 'required',
            'category_id' => 'required',
            'subcategory_name' => 'required',
            'image' => 'required',

        ]);

        $name_slug = Str::of($request->subcategory_name)->slug('-');

        if ($request->file('image')) {

            $img = $request->file('image');
            $name_gen = $name_slug . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(240, 120)->save("image/subcategory/" . $name_gen);
            $img_url = "image/subcategory/" . $name_gen;

            SubCategory::insert([
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'subcategory_name' => $request->subcategory_name,
                'subcategory_slug' => $name_slug,
                'image' => $img_url,
                'subcategory_status' => $request->subcategory_status,
                'created_at' => Carbon::now(),
            ]);
            $notification = array('messege' => 'SubCategory Added Successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    }





    /**
     * Show the form for editing a specific subcategory.
     *
     * This method retrieves the data for a specific subcategory along with all available
     * brands and categories. It then returns a view with the subcategory data to be edited.
     *
     * @param  \Illuminate\Http\Request  $request  The request object containing the subcategory ID.
     * @return \Illuminate\View\View The view for editing the subcategory with the subcategory, brand, and category data.
     */
    public function edit_subcategory(Request $request)
    {
        $req = $request->id;

        // Retrieve all brand and category data
        $brand = Brand::all();
        $category = Categorie::all();

        // Retrieve the specific subcategory data
        $edit = SubCategory::find($req);

        return view('admin.subcategory.edit', compact('brand', 'category', 'edit'));
    }





    /**
     * Update the specified subcategory.
     *
     * This method updates the details of an existing subcategory. It handles both cases where
     * a new image is uploaded and where no image update is needed. If a new image is provided,
     * it replaces the old image and updates the subcategory record with the new image details.
     *
     * @param  \Illuminate\Http\Request  $request  The request object containing the subcategory data to be updated.
     * @return \Illuminate\Http\RedirectResponse Redirects to the subcategory index page with a success message.
     */
    public function subcategory_update(Request $request)
    {
        $update = $request->id;

        $file = SubCategory::findOrFail($update);
        $name = Str::of($request->subcategory_name)->slug('-');

        if ($request->file('image')) {
            // Delete the old image
            $img = $file->image;
            unlink($img);

            // Process and save the new image
            $img = $request->file('image');
            $name_gen = $name . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(240, 120)->save("image/subcategory/" . $name_gen);
            $img_url = "image/subcategory/" . $name_gen;

            // Update the subcategory with new image
            SubCategory::findOrFail($update)->update([
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'subcategory_status' => $request->subcategory_status,
                'subcategory_name' => $request->subcategory_name,
                'subcategory_slug' => $name,
                'image' => $img_url,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array('messege' => 'SubCategory Added Successfully', 'alert-type' => 'success');
            return redirect()->route('subcategory.index')->with($notification);
        } else {
            // Update the subcategory without changing the image
            SubCategory::findOrFail($update)->update([
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'subcategory_status' => $request->subcategory_status,
                'subcategory_name' => $request->subcategory_name,
                'subcategory_slug' => $name,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array('messege' => 'SubCategory Added Successfully', 'alert-type' => 'success');
            return redirect()->route('subcategory.index')->with($notification);
        }
    }






    /**
     * Toggle the status of a subcategory.
     *
     * This method checks the current 'subcategory_status' of a subcategory by its ID and toggles the status between
     * active and inactive. It updates the 'subcategory_status' field in the 'sub_categories' table and redirects
     * back with a success notification indicating whether the subcategory was activated or deactivated.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function subcategory_Status($id)
    {

        $sub_cat_status = DB::table($this->db_sub_category)->where('id', $id)->first();

        $data = array();
        if ($sub_cat_status->subcategory_status == 1) {
            $data['subcategory_status'] = 0;
            DB::table($this->db_sub_category)->where('id', $id)->update($data);

            $notification = array('messege' => 'Deactive Successfully !', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        } else {
            $data['subcategory_status'] = 1;

            DB::table($this->db_sub_category)->where('id', $id)->update($data);

            $notification = array('messege' => 'Active Successfully !', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    }






    /**
     * Delete the specified subcategory.
     *
     * This method deletes the subcategory record from the database and also removes the associated image file
     * from the server. It first finds the subcategory by its ID, deletes the image file, and then removes
     * the subcategory record.
     *
     * @param  \Illuminate\Http\Request  $request  The request object containing the ID of the subcategory to be deleted.
     * @return \Illuminate\Http\RedirectResponse Redirects back to the previous page with a success message.
     */
    public function subcategory_Delete(Request $request)
    {
        $req = $request->id;

        // Find the subcategory record
        $file = SubCategory::find($req);

        // Remove the image file
        $img = $file->image;
        unlink($img);

        // Delete the subcategory record
        SubCategory::findOrFail($req)->delete();

        $notification = array('messege' => 'SubCategory Delete Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
