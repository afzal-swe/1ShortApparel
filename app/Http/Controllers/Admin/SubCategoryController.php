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

class SubCategoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    // View All Sub Categoryes Section //
    public function All_subcategorys()
    {
        $brand = Brand::all();
        $category = Categorie::all();
        $sub_category = SubCategory::orderBy('id', 'DESC')->get();
        return view('admin.subcategory.index', compact('sub_category', 'brand', 'category'));
    } // End

    // Add new Sub Category Section //
    public function Add_subcategory(Request $request)
    {
        $request->validate([
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
    } // End

    // Edit Sub category from section //
    public function edit_subcategory(Request $request)
    {
        $req = $request->id;
        if (!$req == null) {
            $brand = Brand::all();
            $category = Categorie::all();
            $edit = SubCategory::find($req);

            return view('admin.subcategory.edit', compact('brand', 'category', 'edit'));
        } else {
            echo "Not Found";
        }
    } // End

    // Update Sub Category Section //
    public function subcategory_update(Request $request)
    {
        $update = $request->id;

        $file = SubCategory::findOrFail($update);
        $name = Str::of($request->subcategory_name)->slug('-');

        if ($request->file('image')) {
            $img = $file->image;
            unlink($img);

            $img = $request->file('image');
            $name_gen = $name . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(240, 120)->save("image/subcategory/" . $name_gen);
            $img_url = "image/subcategory/" . $name_gen;

            SubCategory::findOrFail($update)->update([
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'subcategory_name' => $request->subcategory_name,
                'subcategory_slug' => $name,
                'image' => $img_url,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array('messege' => 'SubCategory Added Successfully', 'alert-type' => 'success');
            return redirect()->route('subcategory.index')->with($notification);
        } else {
            SubCategory::findOrFail($update)->update([
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'subcategory_name' => $request->subcategory_name,
                'subcategory_slug' => $name,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array('messege' => 'SubCategory Added Successfully', 'alert-type' => 'success');
            return redirect()->route('subcategory.index')->with($notification);
        }
    } // End //

    // Delete Sub Category Section //
    public function subcategory_Delete(Request $request)
    {
        $req = $request->id;

        $file = SubCategory::find($req);
        if ($file !== 'image') {
            $img = $file->image;
            unlink($img);

            SubCategory::findOrFail($req)->delete();

            $notification = array('messege' => 'SubCategory Delete Successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        } else {

            SubCategory::findOrFail($req)->delete();

            $notification = array('messege' => 'SubCategory Delete Successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    } // End
}
