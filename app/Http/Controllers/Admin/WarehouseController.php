<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse;

class WarehouseController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    } // End //

    // View All Sub Categoryes Section //
    public function all_warehouse()
    {

        $warehouse = Warehouse::orderBy('id', 'DESC')->get();
        return view('admin.warehouse.index', compact('warehouse'));
    } // End

    // Ware House Add Section
    public function warehouse_store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'warhouse_name' => 'required',
            'warhouse_address' => 'required|max:60',
            'warhouse_phone' => 'required',

        ]);

        Warehouse::insert([
            'warhouse_name' => $request->warhouse_name,
            'warhouse_address' => $request->warhouse_address,
            'warhouse_phone' => $request->warhouse_phone,
        ]);
        $notification = array('messege' => 'Ware House Insert Successfully !!', 'alert-type' => "success");
        return redirect()->back()->with($notification);
    } // End

    // ware house Edit Form Section //
    public function warehouse_edit(Request $request)
    {
        $req = $request->id;
        if ($req !== Null) {
            $edit = Warehouse::findOrFail($req);
            return view('admin.warehouse.edit', compact('edit'));
        } else {
            echo "Page Not Found !";
        }
    } // End //

    // Ware House Update Section
    public function warehouse_update(Request $request)
    {
        $req = $request->id;
        if ($req !== Null) {
            Warehouse::findOrFail($req)->update([
                'warhouse_name' => $request->warhouse_name,
                'warhouse_address' => $request->warhouse_address,
                'warhouse_phone' => $request->warhouse_phone,
            ]);
            $notification = array('messege' => 'Ware House Insert Successfully !!', 'alert-type' => "success");
            return redirect()->back()->with($notification);
        } else {
            echo "Page Not Found !";
        }
    } // End

    // ware house Delete Section //
    public function warehouse_delete(Request $request)
    {
        $req = $request->id;
        if ($req !== null) {
            Warehouse::findOrFail($req)->delete();

            $notification = array('messege' => 'Page Delete Successfully !!', 'alert-type' => "success");
            return redirect()->back()->with($notification);
        } else {
            echo "Page Not Found !";
        }
    } // End //
}
