<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Smtp;

class SmtpController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    } // End //

    // Create from Section //
    public function smtp_create()
    {
        $smtp = Smtp::first();

        if ($smtp == Null) {
            return view('admin.setting.smtp_section.create');
        } else {
            return view('admin.setting.smtp_section.edit', compact('smtp'));
        }
    } // End

    // Store Smtp section
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
    } // End

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
