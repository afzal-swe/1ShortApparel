<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Brand;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{

    private $db_categories;




    /**
     * Constructor for the controller.
     *
     * Applies the 'auth' middleware to the controller to ensure that only authenticated users can access its methods.
     * Initializes the `$db_categories` property with the name of the categories table.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->db_categories = "categories";
    }




    /**
     * Retrieves all categories and brands, and returns a view with the data.
     *
     * @return \Illuminate\View\View
     */
    public function All_categorys()
    {
        $brand = Brand::all();
        $category = Categorie::orderBy('id', 'DESC')->get();
        return view('admin.category.index', compact('category', 'brand'));
    }






    /**
     * Adds a new category to the database with validation for required fields.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function Add_category(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'brand_id' => 'required',
            'category_name' => 'required|unique:categories',
            'home_page' => 'required',
            'category_status' => 'required',
            'image' => 'required',
        ], [
            'brand_id.required' => 'This brand is required',
            'category_name.required' => 'This category name is required',
            'home_page.required' => 'This home page is required',
            'category_status.required' => 'This status is required',
            'image.required' => 'This image is required',
        ]);

        // Create a slug from the category name
        $slug = Str::of($request->category_name)->slug('-');

        $image = $request->image;
        if ($image) {

            // Generate a name for the image and save it
            $name_gen = $slug . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(32, 32)->save("image/category/" . $name_gen);
            $save_img = "image/category/" . $name_gen;

            // Insert new category record
            Categorie::insert([
                'brand_id' => $request->brand_id,
                'category_name' => $request->category_name,
                'home_page' => $request->home_page,
                'category_status' => $request->category_status,
                'category_slug' => $slug,
                'image' => $save_img,
                'created_at' => Carbon::now(),
            ]);

            // Return back with success notification
            $notification = array('messege' => 'Category Added Successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    }





    /**
     * Displays the form to edit a specific category.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit_category(Request $request)
    {
        // Retrieve the category ID from the request
        $req = $request->id;

        // Retrieve all brands
        $brand = Brand::all();

        // Find the category by its ID
        $edit = Categorie::find($req);

        // Return the edit view with the category and brands data
        return view('admin.category.edit', compact('edit', 'brand'));
    }






    /**
     * Updates a specific category's details.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id  The ID of the category to update.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function category_update(Request $request, $id)
    {
        // Generate a slug from the category name
        $slug = Str::of($request->category_name)->slug('-');

        // Prepare the data for updating the category
        $data = array();
        $data['brand_id'] = $request->brand_id;
        $data['category_name'] = $request->category_name;
        $data['home_page'] = $request->home_page;
        $data['category_status'] = $request->category_status;
        $data['category_slug'] = $slug;
        $data['updated_at'] = Carbon::now();

        // Handle image upload if a new image is provided
        $image = $request->image;
        if ($image) {

            // Retrieve the current category image
            $img = DB::table($this->db_categories)->where('id', $id)->first();
            $old_image = $img->image;

            // Delete the old image file
            unlink($old_image);

            // Generate a new image name and save the resized image
            $img_name = $slug . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(240, 120)->save("image/category/" . $img_name);

            // Set the new image path in the data array
            $data['image'] = "image/category/" . $img_name;
        }

        // Update the category in the database
        DB::table($this->db_categories)->where('id', $id)->update($data);

        // Set a success notification message
        $notification = array('messege' => 'Category Update Successfully', 'alert-type' => 'success');

        // Redirect to the category index page with the notification
        return redirect()->route('category.index')->with($notification);
    }





    /**
     * Toggle the status of a category.
     *
     * This method checks the current status of a category by its ID and toggles the status between active and inactive.
     * It updates the 'category_status' field in the 'categories' table and redirects back with a success notification
     * indicating whether the status was activated or deactivated.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function Category_Status($id)
    {

        $check_status = DB::table($this->db_categories)->where('id', $id)->first();

        $data = array();
        if ($check_status->category_status == 1) {
            $data['category_status'] = 0;
            DB::table($this->db_categories)->where('id', $id)->update($data);

            $notification = array('messege' => 'Status Deactive Successfully !', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        } else {
            $data['category_status'] = 1;

            DB::table($this->db_categories)->where('id', $id)->update($data);

            $notification = array('messege' => 'Status Active Successfully !', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    }







    /**
     * Toggle the homepage status of a category.
     *
     * This method checks the current 'home_page' status of a category by its ID and toggles the status between active
     * and inactive. It updates the 'home_page' field in the 'categories' table and redirects back with a success
     * notification indicating whether the homepage status was activated or deactivated.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function HomePage_Status($id)
    {
        $home_page_status = DB::table($this->db_categories)->where('id', $id)->first();

        $data = array();
        if ($home_page_status->home_page == 1) {
            $data['home_page'] = 0;
            DB::table($this->db_categories)->where('id', $id)->update($data);

            $notification = array('messege' => 'Home Page Deactive Successfully !', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        } else {
            $data['home_page'] = 1;

            DB::table($this->db_categories)->where('id', $id)->update($data);

            $notification = array('messege' => 'Home Page Active Successfully !', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    }





    /**
     * Deletes a specific category.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function category_Delete(Request $request)
    {
        // Retrieve the ID of the category to delete from the request
        $req = $request->id;

        $file = Categorie::findOrFail($req);
        $img = $file->image;
        unlink($img);

        Categorie::findOrFail($req)->delete();

        $notification = array('messege' => 'Category Delete Successfully', 'alert-type' => 'success');
        return redirect()->route('category.index')->with($notification);
    }
}
