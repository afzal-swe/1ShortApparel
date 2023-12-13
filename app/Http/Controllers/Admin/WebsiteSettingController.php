<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\WebsiteSetting;


class WebsiteSettingController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    } // End //

    // Web Site Setting Create From Section //
    public function website_create()
    {
        $setting = WebsiteSetting::first();

        if ($setting == Null) {
            return view('admin.setting.website_setting.create');
        } else {
            return view('admin.setting.website_setting.edit', compact('setting'));
        }
    } // End // 

    public function website_store(Request $request)
    {
        $request->validate([
            'phone_one' => 'required',
            'phone_two' => 'required',
        ]);

        $name = Str::of($request->website_name)->slug('-');

        if ($request->file('logo') || $request->file('favicon')) {

            $logo = $request->file('logo');
            $favicon = $request->file('favicon');

            $logo_name = $name . '.' . $logo->getClientOriginalExtension();
            Image::make($logo)->resize(320, 120)->save("image/website/logo/" . $logo_name);
            $logo_url = "image/website/logo" . $logo_name;

            $favicon_name = $name . '.' . $favicon->getClientOriginalExtension();
            Image::make($favicon)->resize(32, 32)->save("image/website/favicon/" . $favicon_name);
            $favicon_url = "image/website/favicon/" . $favicon_name;

            WebsiteSetting::insert([
                'website_name' => $request->website_name,
                'currency' => $request->currency,
                'phone_one' => $request->phone_one,
                'phone_two' => $request->phone_two,
                'main_email' => $request->main_email,
                'support_email' => $request->support_email,
                'address' => $request->address,
                'description' => $request->description,
                'logo' => $logo_url,
                'favicon' => $favicon_url,
                'created_at' => Carbon::now(),
            ]);
            $notification = array('messege' => 'Website info added Successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        } else {
            WebsiteSetting::insert([
                'website_name' => $request->website_name,
                'currency' => $request->currency,
                'phone_one' => $request->phone_one,
                'phone_two' => $request->phone_two,
                'main_email' => $request->main_email,
                'support_email' => $request->support_email,
                'address' => $request->address,
                'description' => $request->description,
                'created_at' => Carbon::now(),
            ]);
            $notification = array('messege' => 'Website info added Successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    } // End //

    public function website_update(Request $request)
    {
        $update = $request->id;

        $name = Str::of($request->website_name)->slug('-');

        if ($request->file('logo') || $request->file('favicon')) {

            $logo = $request->file('logo');
            $favicon = $request->file('favicon');


            $logo_name = $name . '.' . $logo->getClientOriginalExtension();
            Image::make($logo)->resize(320, 120)->save("image/website/logo/" . $logo_name);
            $logo_url = "image/website/logo" . $logo_name;

            $favicon_name = $name . '.' . $favicon->getClientOriginalExtension();
            Image::make($favicon)->resize(32, 32)->save("image/website/favicon/" . $favicon_name);
            $favicon_url = "image/website/favicon/" . $favicon_name;

            WebsiteSetting::findOrFail($update)->update([
                'website_name' => $request->website_name,
                'currency' => $request->currency,
                'phone_one' => $request->phone_one,
                'phone_two' => $request->phone_two,
                'main_email' => $request->main_email,
                'support_email' => $request->support_email,
                'address' => $request->address,
                'description' => $request->description,
                'logo' => $logo_url,
                'favicon' => $favicon_url,
                'created_at' => Carbon::now(),
            ]);
            $notification = array('messege' => 'Website info Update Successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        } else {
            WebsiteSetting::findOrFail($update)->update([
                'website_name' => $request->website_name,
                'currency' => $request->currency,
                'phone_one' => $request->phone_one,
                'phone_two' => $request->phone_two,
                'main_email' => $request->main_email,
                'support_email' => $request->support_email,
                'address' => $request->address,
                'description' => $request->description,
                'logo' => $request->old_logo,
                'favicon' => $request->old_favicon,
                'created_at' => Carbon::now(),
            ]);
            $notification = array('messege' => 'Website info Update Successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    } // End //
}
