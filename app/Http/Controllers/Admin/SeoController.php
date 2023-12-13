<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seo;

class SeoController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    } // End // 

    // Seo Create Section //
    public function seo_create()
    {
        $seo = Seo::first();

        if ($seo == Null) {
            return view('admin.setting.seo.create');
        } else {
            return view('admin.setting.seo.edit', compact('seo'));
        }
    } // End

    // Seo Add Section
    public function seo_add(Request $request)
    {
        $request->validate([
            'meta_author' => 'required',
            'meta_title' => 'required|max:30',
            'meta_keyword' => 'required',
            'meta_description' => 'required',
            'google_analytics' => 'required',
            'google_verification' => 'required',
            'alexa_analytics' => 'required',
        ]);

        Seo::insert([
            'meta_author' => $request->meta_author,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'google_analytics' => $request->google_analytics,
            'google_verification' => $request->google_verification,
            'alexa_analytics' => $request->alexa_analytics,
        ]);
        $notification = array('messege' => 'SEO Insert Successfully !!', 'alert-type' => "success");
        return redirect()->back()->with($notification);
    } // End

    // Update Seo system //
    public function seo_edit(Request $request)
    {
        $update = $request->id;

        Seo::findOrFail($update)->update([
            'meta_author' => $request->meta_author,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'google_analytics' => $request->google_analytics,
            'google_verification' => $request->google_verification,
            'alexa_analytics' => $request->alexa_analytics,
        ]);
        $notification = array('messege' => 'SEO Update Successfully !!', 'alert-type' => "success");
        return redirect()->back()->with($notification);
    }
}
