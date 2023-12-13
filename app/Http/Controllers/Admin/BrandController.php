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
    // View All Brand Name and image //
    public function All_Brands()
    {

        $brand = Brand::orderBy('id', 'DESC')->get();

        return view('admin.brand.index', compact('brand'));
    } // End

    // Add new brand //
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
    } // End 

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
