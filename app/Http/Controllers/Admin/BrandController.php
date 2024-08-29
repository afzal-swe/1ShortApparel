<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{



    /**
     * Constructor method for applying middleware.
     *
     * This method applies the 'auth' middleware to the controller,
     * ensuring that all routes within this controller require
     * user authentication.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }





    /**
     * Display all brands.
     *
     * This method retrieves all brand records from the database, ordered by their ID in descending order.
     * It then passes the retrieved brand data to the 'admin.brand.index' view for display.
     *
     * @return \Illuminate\View\View
     */
    public function All_Brands()
    {
        $brand = Brand::orderBy('id', 'DESC')->get();

        return view('admin.brand.index', compact('brand'));
    }



    /**
     * Add a new brand.
     *
     * This method handles the addition of a new brand. It first validates the incoming request to ensure
     * that the 'name' and 'image' fields are present and meet specified criteria. If an image file is provided,
     * it generates a unique name for the image based on the brand name, resizes it, and saves it to the designated
     * directory. The brand information, including the name and image path, is then inserted into the 'brands' table.
     * A success notification is prepared, and the user is redirected back to the previous page with the notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function Add_Brand(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:brands|max:50',
            'image' => 'required',
            'status' => 'required',
        ], [
            'name.required' => 'This name is required',
            'image.required' => 'This image is required',
            'status.required' => 'This status is required',
        ]);

        $image = $request->image;

        if ($image) {
            $name = Str::of($request->name)->slug('-');

            $name_gen = $name . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(240, 120)->save("image/brand/" . $name_gen);
            $save_img = "image/brand/" . $name_gen;

            Brand::insert([
                'name' => $request->name,
                'image' => $save_img,
                'status' => $request->status,
            ]);

            $notification = array('messege' => 'Brand Insert Successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    }







    /**
     * Show the form for editing a specific brand.
     *
     * Retrieves the brand record to be edited by its ID
     * and passes it to the view.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function edit_brand(Request $request)
    {
        $req = $request->id;

        $edit = Brand::find($req);
        return view('admin.brand.edit', compact('edit'));
    }





    /**
     * Update the specified brand in the database.
     *
     * Handles both scenarios where an image is provided
     * or not. If an image is provided, it updates the brand's image
     * and removes the old image from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function brand_update(Request $request)
    {
        $update_id = $request->id;

        $image = $request->image;

        if ($image) {

            // Find the existing brand and remove the old image
            $brand_image = Brand::findOrFail($update_id);
            $img = $brand_image->image;
            unlink($img);

            $name = Str::of($request->name)->slug('-');

            // Process the new image
            $name_gen = $name . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(240, 120)->save("image/brand/" . $name_gen);
            $save_img = "image/brand/" . $name_gen;

            // Update the brand with new image
            Brand::findOrFail($update_id)->update([
                'name' => $request->name,
                'image' => $save_img,

            ]);
            $notification = array('messege' => 'Brand Update Successfully', 'alert-type' => 'success');
            return redirect()->route('brand.index')->with($notification);
        }
        // Update the brand without changing the image
        Brand::findOrFail($update_id)->update([
            'name' => $request->name,
        ]);
        $notification = array('messege' => 'Brand Update Successfully', 'alert-type' => 'success');
        return redirect()->route('brand.index')->with($notification);
    }





    /**
     * Delete the specified brand from the database.
     *
     * Deletes the brand and its associated image from the storage.
     *
     * @param int|null $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function Brand_Delete($id = null)
    {

        // Find the brand by ID
        $file = Brand::findOrFail($id);

        // Remove the brand's image from storage
        $img = $file->image;
        unlink($img);

        // Delete the brand from the database
        Brand::findOrFail($id)->delete();

        $notification = array('messege' => 'Brand Delete Successfully', 'alert-type' => 'success');
        return redirect()->route('brand.index')->with($notification);
    }
}
