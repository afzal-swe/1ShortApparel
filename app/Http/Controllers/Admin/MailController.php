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
    //
    private $db_tableName;

    public function __construct()
    {
        $this->middleware('auth');
        $this->db_tableName = "contacts";
    }

    public function mailbox()
    {
        // dd(1);

        $all_mail = DB::table($this->db_tableName)->orderBy('id', 'DESC')->get();
        return view('admin.mail.mailbox', compact('all_mail'));
    }

    public function send_mail()
    {
        // dd(1);

        $send_mail = DB::table($this->db_tableName)->get();
        return view('admin.mail.compose', compact('send_mail'));
    }
}
