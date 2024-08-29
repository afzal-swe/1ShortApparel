<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactMessageController extends Controller
{
    //
    private $db_contact;



    /**
     * Constructor to initialize the database table used in the controller.
     *
     * This constructor method is responsible for initializing the `$db_contact` property,
     * which represents the `contacts` table in the database. This property is used throughout
     * the controller methods to perform database operations related to contacts.
     */
    public function __construct()
    {
        $this->db_contact = "contacts";
    }



    /**
     * Display a list of contact messages.
     *
     * This method retrieves all contact messages from the `contacts` table,
     * ordered by their ID in descending order. It then passes these messages
     * to the view named `admin.contact_message.message_view` for display.
     *
     * @return \Illuminate\View\View
     */
    public function Contact_Message()
    {
        $contact = DB::table($this->db_contact)->orderBy('id', 'DESC')->get();
        return view('admin.contact_message.message_view', compact('contact'));
    }



    /**
     * Delete a contact message.
     *
     * This method deletes a contact message from the `contacts` table based on
     * the provided message ID. After the deletion, it redirects back with a success
     * notification.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function Delete_Message(Request $request)
    {
        $delete = $request->id;
        DB::table($this->db_contact)->where('id', $delete)->delete();
        $notification = array('messege' => 'Message Delete', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
