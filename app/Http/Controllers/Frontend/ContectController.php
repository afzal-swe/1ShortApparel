<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ContectController extends Controller
{
    //


    private $bd_tableName;



    /**
     * Constructor for initializing the controller.
     *
     * Sets the database table name for contacts.
     */
    public function __construct()
    {
        $this->bd_tableName = "contacts";
    }




    /**
     * Show the contact page view.
     *
     * @return \Illuminate\View\View
     */
    public function contact_page()
    {
        return view('frontend.contact.create');
    }





    /**
     * Handle sending contact form data and store it in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function contact_send(Request $request)
    {
        DB::table($this->bd_tableName)->insert([
            "name" => $request->name ?? "Null",
            "email" => $request->email ?? "Null",
            "phone" => $request->phone ?? "Null",
            "desctiption" => $request->desctiption ?? "Null",
            "created_at" => Carbon::now(),
        ]);

        $notification = array('messege' => 'Send Message Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
