<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    private $db_user;


    /**
     * Initialize the controller instance.
     *
     * This constructor sets the database table name for user-related operations.
     */
    public function __construct()
    {
        $this->db_user = "users";
    }



    /**
     * Display a list of users who are not super admins.
     *
     * This method retrieves all users from the `users` table who are not marked as super admins
     * and orders them in descending order by their ID. The retrieved data is then passed to the view
     * for displaying user information.
     *
     * @return \Illuminate\View\View The view showing the list of users.
     */
    public function User_View()
    {
        $view_user = DB::table($this->db_user)
            ->where('supper_admin', 0)
            ->orderBy('id', 'DESC')
            ->get();
        return view('admin.user.user_view', compact('view_user'));
    }




    /**
     * Show the form for editing a specific user.
     *
     * This method retrieves the details of a user with the specified ID from the `users` table
     * and passes the data to the view for editing. The user data is used to populate the form fields
     * in the view.
     *
     * @param  \Illuminate\Http\Request  $request  The request object containing the user ID.
     * @param  int  $id  The ID of the user to be edited.
     * @return \Illuminate\View\View The view for editing the user.
     */
    public function User_Edit(Request $request, $id)
    {
        $edit = DB::table($this->db_user)->where('id', $id)->first();
        return view('admin.user.user_update', compact('edit'));
    }




    /**
     * Update the specified user's information in the database.
     *
     * This method handles the update request for a user with the specified ID. It validates
     * the input data, prepares an array with the updated user information, and updates the
     * `users` table with the new data. After successfully updating, it redirects to the
     * user view page with a success notification.
     *
     * @param  \Illuminate\Http\Request  $request  The request object containing the updated user data.
     * @param  int  $id  The ID of the user to be updated.
     * @return \Illuminate\Http\RedirectResponse Redirects to the user view page with a success message.
     */
    public function User_Update(Request $request, $id)
    {
        $id = $request->id;
        $data = array();
        $data['name'] = $request->name;
        // $data['email'] = $request->email;
        $data['supper_admin'] = 0;
        $data['user_name'] = $request->user_name;
        $data['phone'] = $request->phone;
        $data['category'] = $request->category;
        $data['product'] = $request->product;
        $data['offer'] = $request->offer;
        $data['order'] = $request->order;
        $data['blog'] = $request->blog;
        $data['pickup'] = $request->pickup;
        $data['ticket'] = $request->ticket;
        $data['contact'] = $request->contact;
        $data['report'] = $request->report;
        $data['setting'] = $request->setting;
        $data['userrole'] = $request->userrole;
        $data['status'] = $request->status;
        DB::table($this->db_user)->where('id', $id)->update($data);
        $notification = array('messege' => 'User Updated!', 'alert-type' => 'success');
        return redirect()->route('user.view')->with($notification);
    }



    /**
     * Delete the specified user from the database.
     *
     * This method handles the deletion of a user with the specified ID from the `users` table.
     * After successfully deleting the user, it redirects to the user view page with a success notification.
     *
     * @param  int  $id  The ID of the user to be deleted.
     * @return \Illuminate\Http\RedirectResponse Redirects to the user view page with a success message.
     */
    public function User_Delete($id)
    {
        DB::table($this->db_user)->where('id', $id)->delete();

        $notification = array('messege' => 'User Delete Successfully !', 'alert-type' => 'success');
        return redirect()->route('user.view')->with($notification);
    }
}
