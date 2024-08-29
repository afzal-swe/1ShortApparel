<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pickup_point;
use Illuminate\Support\Carbon;

class PickupController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * Apply the `auth` middleware to ensure that the user is authenticated
     * before accessing any methods in this controller.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }





    /**
     * Display a listing of all pickup points.
     *
     * Retrieve all pickup points from the database, ordered by the latest entries,
     * and return them to the `admin.pickup_point.index` view.
     *
     * @return \Illuminate\View\View
     */
    public function all_pickup_point()
    {
        $data = Pickup_point::latest()->get();
        return view('admin.pickup_point.index', compact('data'));
    }





    /**
     * Store a new pickup point in the database.
     *
     * Validate the request data and insert a new pickup point with the provided details.
     * Redirect to the `all_pickup_point` route with a success notification.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function pickup_point_add(Request $request)
    {

        Pickup_point::insert([
            'pickup_point_name' => $request->pickup_point_name,
            'pickup_point_address' => $request->pickup_point_address,
            'pickup_point_phone' => $request->pickup_point_phone,
            'pickup_point_phone_two' => $request->pickup_point_phone_two,
            'created_at' => Carbon::now(),
        ]);
        $notification = array('messege' => 'Successfully Insert! !!', 'alert-type' => "success");
        return redirect()->route('all_pickup_point')->with($notification);
    }




    /**
     * Show the form for editing a pickup point.
     *
     * Retrieve the pickup point by its ID from the request and return the edit view.
     * If no ID is provided, return a "Page Not Found" message.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\Response
     */
    public function pickup_point_edit(Request $request)
    {
        $req = $request->id;

        if ($req) {
            $data = Pickup_point::findOrFail($req);
            return view('admin.pickup_point.edit', compact('data'));
        } else {
            return response("Page Not Found!", 404);
        }
    }


    /**
     * Update the specified pickup point in the database.
     *
     * This method handles the update request for a pickup point, validating the input,
     * and updating the `Pickup_point` model with the new data. After successfully updating,
     * it redirects to the list of all pickup points with a success notification.
     *
     * @param  \Illuminate\Http\Request  $request  The request object containing input data.
     * @return \Illuminate\Http\RedirectResponse Redirects to the list of all pickup points with a success message.
     */
    public function pickup_point_update(Request $request)
    {
        $update_id = $request->id;

        if ($update_id) {
            Pickup_point::findOrFail($update_id)->update([
                'pickup_point_name' => $request->pickup_point_name,
                'pickup_point_address' => $request->pickup_point_address,
                'pickup_point_phone' => $request->pickup_point_phone,
                'pickup_point_phone_two' => $request->pickup_point_phone_two,
                'created_at' => Carbon::now(),
            ]);

            $notification = array('messege' => 'Successfully Updated!', 'alert-type' => 'success');
            return redirect()->route('all_pickup_point')->with($notification);
        } else {
            return response()->json(['error' => 'Page Not Found!'], 404);
        }
    }



    /**
     * Delete the specified pickup point from the database.
     *
     * This method handles the delete request for a pickup point by finding it using the provided ID
     * and deleting the record. After successfully deleting, it redirects back with a success notification.
     *
     * @param  \Illuminate\Http\Request  $request  The request object containing the ID of the pickup point to delete.
     * @return \Illuminate\Http\RedirectResponse Redirects back with a success message.
     */
    public function pickup_point_delete(Request $request)
    {
        $req = $request->id;

        if ($req) {
            Pickup_point::findOrFail($req)->delete();

            $notification = array('messege' => 'Deleted Successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        } else {
            return response()->json(['error' => 'Page Not Found!'], 404);
        }
    }
}
