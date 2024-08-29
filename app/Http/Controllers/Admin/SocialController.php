<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Social;
use Illuminate\Support\Carbon;

class SocialController extends Controller
{


    /**
     * Constructor to initialize the controller.
     *
     * This constructor applies the 'auth' middleware to ensure that all actions in the controller
     * are accessible only by authenticated users.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Display the form for creating or editing social settings.
     *
     * This method checks if social settings already exist. If they do, it returns the edit view
     * with the existing social settings. If not, it returns the create view to add new social settings.
     *
     * @return \Illuminate\View\View
     */
    public function social_create()
    {
        $social = Social::first();

        if ($social) {
            return view('admin.setting.social_section.edit', compact('social'));
        } else {
            return view('admin.setting.social_section.create');
        }
    }


    /**
     * Store new social media settings in the database.
     *
     * This method validates the input, inserts new social media settings into the `social` table,
     * and then redirects back with a success notification.
     *
     * @param  \Illuminate\Http\Request  $request  The request object containing input data.
     * @return \Illuminate\Http\RedirectResponse Redirects back with a success message.
     */
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
    }





    /**
     * Update the specified social media settings in the database.
     *
     * This method updates the existing social media settings in the `social` table with new data.
     * After successfully updating, it redirects back with a success notification.
     *
     * @param  \Illuminate\Http\Request  $request  The request object containing updated data.
     * @return \Illuminate\Http\RedirectResponse Redirects back with a success message.
     */
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
    }
}
