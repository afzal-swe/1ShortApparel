<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactMessageController extends Controller
{
    //
    private $db_contact;

    public function __construct()
    {
        $this->db_contact = "contacts";
    }

    public function Contact_Message()
    {
        $contact = DB::table($this->db_contact)->orderBy('id', 'DESC')->get();
        return view('admin.contact_message.message_view', compact('contact'));
    }

    public function Delete_Message(Request $request)
    {
        $delete = $request->id;
        DB::table($this->db_contact)->where('id', $delete)->delete();
        $notification = array('messege' => 'Message Delete', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
