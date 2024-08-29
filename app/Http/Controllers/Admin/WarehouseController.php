<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse;

class WarehouseController extends Controller
{


    /**
     * Constructor for initializing middleware.
     *
     * This constructor applies the `auth` middleware to the controller, ensuring that
     * only authenticated users can access the controller's methods.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Display a listing of all warehouses.
     *
     * This method retrieves all warehouse records from the database, ordered by
     * their IDs in descending order. It then returns a view displaying these
     * warehouse records.
     *
     * @return \Illuminate\View\View The view displaying the list of warehouses.
     */
    public function all_warehouse()
    {

        $warehouse = Warehouse::orderBy('id', 'DESC')->get();
        return view('admin.warehouse.index', compact('warehouse'));
    }



    /**
     * Store a newly created warehouse in the database.
     *
     * This method validates the request input for creating a new warehouse, then
     * inserts the new warehouse data into the database. After successfully inserting
     * the data, it redirects back with a success notification.
     *
     * @param  \Illuminate\Http\Request  $request  The request object containing input data.
     * @return \Illuminate\Http\RedirectResponse Redirects back with a success message.
     */
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
    }


    /**
     * Show the form for editing the specified warehouse.
     *
     * This method retrieves the warehouse data based on the provided ID and
     * returns a view for editing the warehouse details.
     *
     * @param  \Illuminate\Http\Request  $request  The request object containing the warehouse ID.
     * @return \Illuminate\View\View Returns a view for editing the warehouse with the current data.
     */
    public function warehouse_edit(Request $request)
    {
        $req = $request->id;

        $edit = Warehouse::findOrFail($req);
        return view('admin.warehouse.edit', compact('edit'));
    }




    /**
     * Update the specified warehouse in the database.
     *
     * This method updates the details of a warehouse based on the provided ID
     * and input data from the request. After the update, it redirects back with
     * a success notification.
     *
     * @param  \Illuminate\Http\Request  $request  The request object containing input data and warehouse ID.
     * @return \Illuminate\Http\RedirectResponse Redirects back with a success message.
     */
    public function warehouse_update(Request $request)
    {
        $req = $request->id;

        Warehouse::findOrFail($req)->update([
            'warhouse_name' => $request->warhouse_name,
            'warhouse_address' => $request->warhouse_address,
            'warhouse_phone' => $request->warhouse_phone,
        ]);
        $notification = array('messege' => 'Ware House Insert Successfully !!', 'alert-type' => "success");
        return redirect()->back()->with($notification);
    }



    /**
     * Delete the specified warehouse from the database.
     *
     * This method deletes a warehouse record based on the provided ID from
     * the request. After the deletion, it redirects back with a success notification.
     *
     * @param  \Illuminate\Http\Request  $request  The request object containing the warehouse ID.
     * @return \Illuminate\Http\RedirectResponse Redirects back with a success message.
     */
    public function warehouse_delete(Request $request)
    {
        $req = $request->id;

        Warehouse::findOrFail($req)->delete();

        $notification = array('messege' => 'Page Delete Successfully !!', 'alert-type' => "success");
        return redirect()->back()->with($notification);
    }
}
