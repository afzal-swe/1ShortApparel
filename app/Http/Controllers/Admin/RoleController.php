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

    public function __construct()
    {
        $this->db_user = "users";
    }

    //__role index
    public function index()
    {
        $data = DB::table($this->db_user)->where('status', 1)->get();
        return view('admin.role.role_view', compact('data'));
    }

    //__create roll
    public function Role_Create()
    {
        return view('admin.role.role_create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|unique:users',
        ]);

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
        DB::table($this->db_user)->insert($data);
        $notification = array('messege' => 'Role Created!', 'alert-type' => 'success');
        return redirect()->route('manage.role')->with($notification);
    }

    //__edit method
    public function edit($id)
    {
        $data = DB::table('users')->where('id', $id)->first();
        return view('admin.role.role_edit', compact('data'));
    }

    //__update method
    public function update(Request $request)
    {
        $id = $request->id;
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
        DB::table('users')->where('id', $id)->update($data);
        $notification = array('messege' => 'Role Updated!', 'alert-type' => 'success');
        return redirect()->route('manage.role')->with($notification);
    }


    //__destroy__
    public function destroy($id)
    {
        DB::table($this->db_user)->where('id', $id)->delete();
        $notification = array('messege' => 'Role Deleted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
