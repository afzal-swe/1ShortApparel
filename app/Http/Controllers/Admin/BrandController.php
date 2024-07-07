<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    //
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
        ]);

        if ($request->file('image')) {
            $name = Str::of($request->name)->slug('-');
            $img = $request->file('image');
            $name_gen = $name . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(240, 120)->save("image/brand/" . $name_gen);
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


    // Edit from view function //
    public function edit_brand(Request $request)
    {
        $req = $request->id;
        if (!$req == null) {
            $edit = Brand::find($req);
            return view('admin.brand.edit', compact('edit'));
        } else {
            echo "Not Found";
        }
    } // End

    public function brand_update(Request $request)
    {
        $update = $request->id;
        $file = Brand::findOrFail($update);

        if ($request->file('image')) {

            $img = $file->image;
            unlink($img);

            $name = Str::of($request->name)->slug('-');

            $img = $request->file('image');

            $name_gen = $name . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(240, 120)->save("image/brand/" . $name_gen);

            $save_img = "image/brand/" . $name_gen;

            Brand::findOrFail($update)->update([
                'name' => $request->name,
                'image' => $save_img,

            ]);
            $notification = array('messege' => 'Brand Insert Successfully', 'alert-type' => 'success');
            return redirect()->route('brand.index')->with($notification);
        } else {
            Brand::findOrFail($update)->update([
                'name' => $request->name,
            ]);
            $notification = array('messege' => 'Brand Insert Successfully', 'alert-type' => 'success');
            return redirect()->route('brand.index')->with($notification);
        }
    }

    // Brand Delete function Section //
    public function Brand_Delete($id = null)
    {

        $file = Brand::findOrFail($id);

        if ($file !== 'image') {
            $img = $file->image;
            unlink($img);

            Brand::findOrFail($id)->delete();

            $notification = array('messege' => 'Brand Delete Successfully', 'alert-type' => 'success');
            return redirect()->route('brand.index')->with($notification);
        } else {

            Brand::findOrFail($id)->delete();

            $notification = array('messege' => 'Brand Delete Successfully', 'alert-type' => 'success');
            return redirect()->route('brand.index')->with($notification);
        }
    } // End
}
