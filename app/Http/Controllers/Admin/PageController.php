<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\Page;

class PageController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    } // End // 

    // View All page section //
    public function all_page()
    {
        $page = Page::orderBy('id', 'DESC')->get();
        return view('admin.setting.page.index', compact('page'));
    } // End

    // Create new page from section //
    public function page_create()
    {

        return view('admin.setting.page.create');
    } // End

    // Add new page // 
    public function page_added(Request $request)
    {
        $request->validate([
            'page_position' => 'required',
            'page_name' => 'required',
            'page_title' => 'required',
        ]);

        Page::insert([
            'page_position' => $request->page_position,
            'page_name' => $request->page_name,
            'page_title' => $request->page_title,
            'page_description' => $request->page_description,
            'page_slug' => Str::of($request->page_title)->slug('-'),
            'page_status' => $request->page_status,
            'created_at' => Carbon::now(),
        ]);
        $notification = array('messege' => 'Create a New Page !!', 'alert-type' => "success");
        return redirect()->route('page.all')->with($notification);
    } // End //

    // Page Edit From Section //
    public function page_edit(Request $request)
    {
        $req = $request->id;
        if ($req !== Null) {
            $edit = Page::findOrFail($req);
            return view('admin.setting.page.edit', compact('edit'));
        } else {
            echo "Page Not Found !";
        }
    } // End //

    // Page Update section //
    public function page_update(Request $request)
    {
        $update = $request->id;

        Page::findOrFail($update)->update([
            'page_position' => $request->page_position,
            'page_name' => $request->page_name,
            'page_title' => $request->page_title,
            'page_description' => $request->page_description,
            'page_slug' => Str::of($request->page_title)->slug('-'),
            'updated_at' => Carbon::now(),
        ]);
        $notification = array('messege' => 'Page Update Successfully !!', 'alert-type' => "success");
        return redirect()->route('page.all')->with($notification);
    } // End //

    // Page Delete Section //
    public function page_delete(Request $request)
    {
        $req = $request->id;
        if ($req !== null) {
            Page::findOrFail($req)->delete();

            $notification = array('messege' => 'Page Delete Successfully !!', 'alert-type' => "success");
            return redirect()->back()->with($notification);
        } else {
            echo "Page Not Found !";
        }
    } // End //
}
