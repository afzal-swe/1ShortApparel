<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Smtp;

class SmtpController extends Controller
{



    /**
     * Initialize the controller and apply middleware.
     *
     * This constructor applies the 'auth' middleware to all methods in the controller,
     * ensuring that the user must be authenticated to access any action within this controller.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }




    /**
     * Show the form for creating or editing SMTP settings.
     *
     * This method checks if SMTP settings exist in the database. If settings are found,
     * it returns the view for editing the existing SMTP settings. If no settings are found,
     * it returns the view for creating new SMTP settings.
     *
     * @return \Illuminate\View\View The view for creating or editing SMTP settings.
     */
    public function smtp_create()
    {
        $smtp = Smtp::first();

        if ($smtp) {
            return view('admin.setting.smtp_section.edit', compact('smtp'));
        } else {
            return view('admin.setting.smtp_section.create');
        }
    }




    /**
     * Store new SMTP settings in the database.
     *
     * This method validates the SMTP settings input, inserts the new settings into the database,
     * and then redirects back with a success notification.
     *
     * @param  \Illuminate\Http\Request  $request  The request object containing SMTP settings data.
     * @return \Illuminate\Http\RedirectResponse Redirects back with a success message.
     */
    public function smtp_store(Request $request)
    {

        $request->validate([
            'mailer' => 'required',
        ]);

        Smtp::insert([
            'mailer' => $request->mailer,
            'host' => $request->host,
            'port' => $request->port,
            'user_name' => $request->user_name,
            'password' => $request->password,
        ]);
        $notification = array('messege' => 'SMTP Added Successfully !!', 'alert-type' => "success");
        return redirect()->back()->with($notification);
    }



    /**
     * Update the specified SMTP settings in the database.
     *
     * This method updates the SMTP settings with the provided data, based on the specified ID,
     * and then redirects back with a success notification.
     *
     * @param  \Illuminate\Http\Request  $request  The request object containing updated SMTP settings data.
     * @return \Illuminate\Http\RedirectResponse Redirects back with a success message.
     */
    public function smtp_edit(Request $request)
    {
        $update = $request->id;

        Smtp::findOrFail($update)->update([
            'mailer' => $request->mailer,
            'host' => $request->host,
            'port' => $request->port,
            'user_name' => $request->user_name,
            'password' => $request->password,
        ]);
        $notification = array('messege' => 'SMTP Update Successfully !!', 'alert-type' => "success");
        return redirect()->back()->with($notification);
    }
}
