<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class BlogController extends Controller
{
    //
    private $db_blog;
    private $db_blog_category;

    public function __construct()
    {
        $this->db_blog = "blogs";
        $this->db_blog_category = "blog_category";
    }

    //all category showing method
    public function Blog_Category()
    {
        $data = DB::table($this->db_blog_category)->get();  //query builder
        return view('admin.blog_category.view_blog', compact('data'));
    }

    //store category
    public function Blog_Store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|max:55',
        ]);

        //query builder
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_slug'] = Str::slug($request->category_name, '-');
        $data['created_at'] = Carbon::now();
        DB::table($this->db_blog_category)->insert($data);

        $notification = array('messege' => 'Category Inserted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function Blog_Destroy($id)
    {
        DB::table($this->db_blog_category)->where('id', $id)->delete();
        $notification = array('messege' => 'Category Deleted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function Blog_Edit($id)
    {
        $data = DB::table($this->db_blog_category)->where('id', $id)->first();
        return view('admin.blog_category.edit_blog', compact('data'));
    }

    public function Blog_Update(Request $request)
    {

        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_slug'] = Str::slug($request->category_name, '-');
        $data['updated_at'] = Carbon::now();
        DB::table($this->db_blog_category)->where('id', $request->id)->update($data);
        $notification = array('messege' => 'Category Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
