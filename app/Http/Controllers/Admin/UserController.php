<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    private $db_user;

    public function __construct()
    {
        $this->db_user = "users";
    }

    // View All User
    public function User_View()
    {
        $view_user = DB::table($this->db_user)->where('supper_admin', 0)->orderBy('id', 'DESC')->get();
        return view('admin.user.user_view', compact('view_user'));
    }

    // User Edit Function
    public function User_Edit(Request $request, $id)
    {
        $edit = DB::table($this->db_user)->where('id', $id)->first();
        return view('admin.user.user_update', compact('edit'));
    }

    // User Update Function
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

    // User Delete Function
    public function User_Delete($id)
    {
        DB::table($this->db_user)->where('id', $id)->delete();

        $notification = array('messege' => 'User Delete Successfully !', 'alert-type' => 'success');
        return redirect()->route('user.view')->with($notification);
    }
}
