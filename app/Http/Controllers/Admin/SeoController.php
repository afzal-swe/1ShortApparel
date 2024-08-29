<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seo;

class SeoController extends Controller
{


    /**
     * Initialize the controller and apply middleware.
     *
     * This constructor method sets up the controller, applying the `auth` middleware
     * to ensure that only authenticated users can access the routes handled by this controller.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Show the SEO settings form.
     *
     * This method checks if there is an existing SEO record in the database. If a record
     * exists, it returns the view for editing the SEO settings with the existing data.
     * If no record is found, it returns the view for creating new SEO settings.
     *
     * @return \Illuminate\View\View The view for creating or editing SEO settings.
     */
    public function seo_create()
    {
        $seo = Seo::first();

        if ($seo) {
            return view('admin.setting.seo.edit', compact('seo'));
        } else {
            return view('admin.setting.seo.create');
        }
    }




    /**
     * Store new SEO settings in the database.
     *
     * This method validates the incoming request for required SEO settings fields.
     * After validation, it inserts the new SEO settings into the database.
     * Upon successful insertion, it redirects back with a success notification.
     *
     * @param  \Illuminate\Http\Request  $request  The request object containing SEO settings data.
     * @return \Illuminate\Http\RedirectResponse Redirects back with a success message.
     */
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
    }




    /**
     * Update the specified SEO settings in the database.
     *
     * This method updates the SEO settings with the given data. It first finds the
     * existing SEO record by its ID and then updates it with the new values provided
     * in the request. After a successful update, it redirects back with a success notification.
     *
     * @param  \Illuminate\Http\Request  $request  The request object containing updated SEO settings data.
     * @return \Illuminate\Http\RedirectResponse Redirects back with a success message.
     */
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
