<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Brand;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Carbon;


class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    // All Category View Section //
    public function All_categorys()
    {
        $brand = Brand::all();
        $category = Categorie::orderBy('id', 'DESC')->get();
        return view('admin.category.index', compact('category', 'brand'));
    } // End

    // Add new Category Section //
    public function Add_category(Request $request)
    {
        $request->validate([
            'brand_id' => 'required',
            'category_name' => 'required',
            'image' => 'required',
        ]);

        $slug = Str::of($request->category_name)->slug('-');

        if ($request->file('image')) {
            $img = $request->image;

            $name_gen = $slug . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(32, 32)->save("image/category/" . $name_gen);

            $save_img = "image/category/" . $name_gen;

            Categorie::insert([
                'brand_id' => $request->brand_id,
                'category_name' => $request->category_name,
                'home_page' => $request->home_page,
                'category_status' => $request->category_status,
                'category_slug' => $slug,
                'image' => $save_img,
                'created_at' => Carbon::now(),
            ]);
            $notification = array('messege' => 'Category Added Successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    } // End

    // Edit Category From Section
    public function edit_category(Request $request)
    {
        $req = $request->id;
        if (!$req == null) {
            $brand = Brand::all();
            $edit = Categorie::find($req);
            return view('admin.category.edit', compact('edit', 'brand'));
        } else {
            echo "Not Found";
        }
    } // End

    public function category_update(Request $request)
    {
        $update = $request->id;

        $file = Categorie::findOrFail($update);

        $slug = Str::of($request->category_name)->slug('-');

        if ($request->file('image')) {

            $img = $file->image;
            unlink($img);

            $img = $request->file('image');

            $img_name = $slug . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(240, 120)->save("image/category/" . $img_name);

            $img_url = "image/category/" . $img_name;

            Categorie::findOrFail($update)->update([
                'brand_id' => $request->brand_id,
                'category_name' => $request->category_name,
                'category_slug' => $slug,
                'image' => $img_url,
                'updated_at' => Carbon::now(),

            ]);
            $notification = array('messege' => 'Category Update Successfully', 'alert-type' => 'success');
            return redirect()->route('category.index')->with($notification);
        } else {
            Categorie::findOrFail($update)->update([
                'brand_id' => $request->brand_id,
                'category_name' => $request->category_name,
                'category_slug' => $slug,
                'updated_at' => Carbon::now(),

            ]);
            $notification = array('messege' => 'Category Update Successfully', 'alert-type' => 'success');
            return redirect()->route('category.index')->with($notification);
        }
    } // End

    // Delete Category Section //
    public function category_Delete(Request $request)
    {
        $req = $request->id;

        $file = Categorie::findOrFail($req);

        if ($file !== 'image') {
            $img = $file->image;
            unlink($img);

            Categorie::findOrFail($req)->delete();

            $notification = array('messege' => 'Category Delete Successfully', 'alert-type' => 'success');
            return redirect()->route('category.index')->with($notification);
        } else {

            Categorie::findOrFail($req)->delete();

            $notification = array('messege' => 'Category Delete Successfully', 'alert-type' => 'success');
            return redirect()->route('category.index')->with($notification);
        }
    } // End
}
