<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class MailController extends Controller
{


    private $db_tableName;



    /**
     * Create a new instance of the controller and apply middleware.
     *
     * Applies the 'auth' middleware to ensure that only authenticated users can access
     * the methods of this controller. Initializes the database table name used for
     * contacts.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->db_tableName = "contacts";
    }




    /**
     * Retrieve and display all mail records.
     *
     * Fetches all records from the 'contacts' table, orders them by ID in descending
     * order, and passes the data to the 'admin.mail.mailbox' view.
     *
     * @return \Illuminate\View\View
     */
    public function mailbox()
    {
        // dd(1);
        $all_mail = DB::table($this->db_tableName)->orderBy('id', 'DESC')->get();
        return view('admin.mail.mailbox', compact('all_mail'));
    }





    /**
     * Retrieve and display all mail records for composing.
     *
     * Fetches all records from the 'contacts' table and passes the data to the
     * 'admin.mail.compose' view for composing new mail.
     *
     * @return \Illuminate\View\View
     */
    public function send_mail()
    {
        // dd(1);
        $send_mail = DB::table($this->db_tableName)->get();
        return view('admin.mail.compose', compact('send_mail'));
    }
}
