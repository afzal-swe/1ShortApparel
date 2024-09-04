<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\WebsiteSetting;
use Illuminate\Support\Facades\DB;


class WebsiteSettingController extends Controller
{
    //

    private $db_website_settings;






    /**
     * Class constructor.
     *
     * This constructor applies the 'auth' middleware to all methods, ensuring that
     * only authenticated users can access them. It also initializes the 
     * `$db_website_settings` property to reference the 'website_settings' table.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->db_website_settings = 'website_settings';
    }






    /**
     * Display the website settings form.
     *
     * This method retrieves the first record from the `WebsiteSetting` model. If a 
     * setting already exists, the method returns the edit view with the existing 
     * settings. Otherwise, it returns the create view.
     *
     * @return \Illuminate\View\View
     */
    public function website_create()
    {
        $setting = WebsiteSetting::first();

        if ($setting) {
            return view('admin.setting.website_setting.edit', compact('setting'));
        } else {
            return view('admin.setting.website_setting.create', compact('setting'));
        }
    }








    /**
     * Store website settings in the database.
     *
     * This method validates the incoming request, processes the uploaded logo and 
     * favicon images if present, and saves the website settings to the database. 
     * It also handles the generation of image URLs and stores the settings along 
     * with the image URLs in the `WebsiteSetting` model.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
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
            Image::make($favicon)->resize(42, 42)->save("image/website/favicon/" . $favicon_name);
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
    }








    /**
     * Update website settings in the database.
     *
     * This method handles updating the website settings in the database, including 
     * updating the logo and favicon images if provided. It also manages the removal 
     * of old images from the server and the insertion of new image paths in the 
     * database. The method uses the ID of the settings record to identify which 
     * record to update.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function website_update(Request $request)
    {
        $update = $request->id;

        $name = Str::of($request->website_name)->slug('-');

        $data = array();
        $data['website_name'] = $request->website_name;
        $data['currency'] = $request->currency;
        $data['phone_one'] = $request->phone_one;
        $data['phone_two'] = $request->phone_two;
        $data['main_email'] = $request->main_email;
        $data['support_email'] = $request->support_email;
        $data['address'] = $request->address;
        $data['description'] = $request->description;
        $data['created_at'] = Carbon::now();


        $request_logo = $request->logo;
        $request_favicon = $request->favicon;

        if ($request_logo) {

            $settomgs_data = DB::table($this->db_website_settings)->where('id', $update)->first();
            $image_logo = $settomgs_data->logo;
            if ($image_logo) {

                unlink($image_logo);

                $logo_name = $name . '.' . $request_logo->getClientOriginalExtension();
                Image::make($request_logo)->resize(320, 120)->save("image/website/logo/" . $logo_name);
                $data['logo'] = "image/website/logo" . $logo_name;
            }

            $logo_name = $name . '.' . $request_logo->getClientOriginalExtension();
            Image::make($request_logo)->resize(320, 120)->save("image/website/logo/" . $logo_name);
            $data['logo'] = "image/website/logo/" . $logo_name;
        }

        if ($request_favicon) {
            $settomgs_data = DB::table($this->db_website_settings)->where('id', $update)->first();
            $old_favicon = $settomgs_data->favicon;
            if ($old_favicon) {

                unlink($old_favicon);

                $favicon_name = $name . '.' . $request_favicon->getClientOriginalExtension();
                Image::make($request_favicon)->resize(32, 32)->save("image/website/favicon/" . $favicon_name);
                $data['favicon'] = "image/website/favicon/" . $favicon_name;
            }

            $favicon_name = $name . '.' . $request_favicon->getClientOriginalExtension();
            Image::make($request_favicon)->resize(32, 32)->save("image/website/favicon/" . $favicon_name);
            $data['favicon'] = "image/website/favicon/" . $favicon_name;
        }

        DB::table($this->db_website_settings)->where('id', $update)->update($data);

        $notification = array('messege' => 'Website info Update Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
