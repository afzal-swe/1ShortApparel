<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pickup_point;
use Illuminate\Support\Carbon;

class PickupController extends Controller
{
    //
    //
    public function __construct()
    {
        $this->middleware('auth');
    } // End //

    // View All Pickup_point Section //
    public function all_pickup_point()
    {
        $data = Pickup_point::latest()->get();
        return view('admin.pickup_point.index', compact('data'));
    } // End //

    // Add New Pickup Point Section //
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
    } // End //

    // Edit Pickup_point Section //
    public function pickup_point_edit(Request $request)
    {
        $req = $request->id;

        if ($req !== Null) {
            $data = Pickup_point::findOrFail($req);
            return view('admin.pickup_point.edit', compact('data'));
        } else {
            echo "Page Not Found !";
        }
    } // End //

    public function pickup_point_update(Request $request)
    {

        $req = $request->id;

        if ($req !== Null) {
            Pickup_point::findOrFail($req)->update([
                'pickup_point_name' => $request->pickup_point_name,
                'pickup_point_address' => $request->pickup_point_address,
                'pickup_point_phone' => $request->pickup_point_phone,
                'pickup_point_phone_two' => $request->pickup_point_phone_two,
                'created_at' => Carbon::now(),
            ]);
            $notification = array('messege' => 'Successfully Update !!', 'alert-type' => "success");
            return redirect()->route('all_pickup_point')->with($notification);
        } else {
            echo "Page Not Found !";
        }
    }

    // Delet Pickup Point Section //
    public function pickup_point_delete(Request $request)
    {
        $req = $request->id;

        if ($req !== Null) {
            Pickup_point::findOrFail($req)->delete();

            $notification = array('messege' => 'Delete Successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        } else {
            echo "Page Not Found !";
        }
    } // End //
}
