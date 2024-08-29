<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleController extends Controller
{
    //
    private $db_user;




    /**
     * Create a new instance of the controller.
     *
     * This constructor sets the database table name for users.
     */
    public function __construct()
    {
        $this->db_user = "users";
    }




    /**
     * Display a listing of the active users.
     *
     * This method retrieves all users with an active status (status = 1)
     * from the `users` table and passes the data to the view for display.
     *
     * @return \Illuminate\View\View The view with the list of active users.
     */
    public function index()
    {
        $data = DB::table($this->db_user)->where('status', 1)->get();
        return view('admin.role.role_view', compact('data'));
    }




    /**
     * Show the form for creating a new role.
     *
     * This method returns the view for creating a new role.
     *
     * @return \Illuminate\View\View The view for creating a new role.
     */
    public function Role_Create()
    {
        return view('admin.role.role_create');
    }




    /**
     * Store a newly created role in the database.
     *
     * This method handles the creation of a new user role by validating the input,
     * hashing the password, and inserting the data into the `users` table. After
     * successfully creating the role, it redirects to the role management page with
     * a success notification.
     *
     * @param  \Illuminate\Http\Request  $request  The request object containing input data.
     * @return \Illuminate\Http\RedirectResponse Redirects to the role management page with a success message.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'email' => 'required|unique:users',
        ]);

        // Prepare data for insertion
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['supper_admin'] = 0;
        $data['password'] = Hash::make($request->password);
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
        // $data['is_admin'] = 1;
        // $data['role_admin'] = 1;

        // Insert data into the database
        DB::table($this->db_user)->insert($data);

        // Prepare success notification
        $notification = array('messege' => 'Role Created!', 'alert-type' => 'success');

        // Redirect with notification
        return redirect()->route('manage.role')->with($notification);
    }




    /**
     * Show the form for editing the specified user role.
     *
     * This method retrieves the details of a user role by its ID from the `users` table
     * and returns a view to display the edit form with the user's current data.
     *
     * @param  int  $id  The ID of the user role to edit.
     * @return \Illuminate\View\View Returns the view with the user data to edit.
     */
    public function edit($id)
    {
        // Retrieve the user role by ID
        $data = DB::table('users')->where('id', $id)->first();

        // Return the edit view with the user data
        return view('admin.role.role_edit', compact('data'));
    }






    /**
     * Update the specified user role in the database.
     *
     * This method handles the update request for a user role, validating the input,
     * and updating the `users` table with the new role data based on the provided ID.
     * After successfully updating, it redirects back with a success notification.
     *
     * @param  \Illuminate\Http\Request  $request  The request object containing input data.
     * @return \Illuminate\Http\RedirectResponse Redirects back with a success message.
     */
    public function update(Request $request)
    {
        // Retrieve the ID from the request
        $id = $request->id;

        // Prepare the data for update
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['supper_admin'] = 0;
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

        // Update the user role by ID
        DB::table('users')->where('id', $id)->update($data);

        // Prepare a success notification message
        $notification = array('messege' => 'Role Updated!', 'alert-type' => 'success');

        // Redirect back with the notification
        return redirect()->route('manage.role')->with($notification);
    }



    /**
     * Remove the specified user role from the database.
     *
     * This method handles the delete request for a user role, removing the record from
     * the `users` table based on the provided ID. After successfully deleting, it redirects
     * back with a success notification.
     *
     * @param  int  $id  The ID of the user role to be deleted.
     * @return \Illuminate\Http\RedirectResponse Redirects back with a success message.
     */
    public function destroy($id)
    {
        // Delete the user role by ID
        DB::table($this->db_user)->where('id', $id)->delete();

        // Prepare a success notification message
        $notification = array('messege' => 'Role Deleted!', 'alert-type' => 'success');

        // Redirect back with the notification
        return redirect()->back()->with($notification);
    }
}
