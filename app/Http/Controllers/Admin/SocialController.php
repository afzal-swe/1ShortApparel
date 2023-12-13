<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Social;
use Illuminate\Support\Carbon;

class SocialController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    } // End

    // Add Social info form // 
    public function social_create()
    {
        $social = Social::first();

        if ($social == Null) {
            return view('admin.setting.social_section.create');
        } else {
            return view('admin.setting.social_section.edit', compact('social'));
        }
    } // End

    // add social info //
    public function social_store(Request $request)
    {
        $request->validate([
            'facebook' => 'required',
        ]);

        Social::insert([
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'youtube' => $request->youtube,
            'instagram' => $request->instagram,
            'linkedin' => $request->linkedin,
            'created_at' => Carbon::now(),
        ]);
        $notification = array('messege' => 'Social Insert Successfully !!', 'alert-type' => "success");
        return redirect()->back()->with($notification);
    } // End //

    // Update Social Section //
    public function social_update(Request $request)
    {
        $update = $request->id;

        Social::findOrFail($update)->update([
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'youtube' => $request->youtube,
            'instagram' => $request->instagram,
            'linkedin' => $request->linkedin,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array('messege' => 'Social Update Successfully !!', 'alert-type' => "success");
        return redirect()->back()->with($notification);
    } // End
}
