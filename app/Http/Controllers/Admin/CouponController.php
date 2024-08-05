<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Coupon;

class CouponController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    } // End //

    // View All Coupon Section //
    public function all_coupon()
    {
        $data = Coupon::latest()->get();
        return view('admin.offer.coupon.index', compact('data'));
    } // End //

    // Add New Coupon Section //
    public function coupon_add(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required',
            'coupon_amount' => 'required',
        ]);

        Coupon::insert([
            'coupon_code' => $request->coupon_code,
            'valid_date' => $request->valid_date,
            'coupon_amount' => $request->coupon_amount,
            'status' => $request->status,
            'type' => $request->type,
            'created_at' => Carbon::now(),
        ]);
        $notification = array('messege' => 'Coupon Create Successfully', 'alert-type' => 'success');
        return redirect()->route('coupon.all_coupon')->with($notification);
    } // End //

    // Edit coupon 
    public function coupon_edit(Request $request)
    {
        $req = $request->id;

        if ($req !== Null) {
            $edit = Coupon::findOrFail($req);
            return view('admin.offer.coupon.edit', compact('edit'));
        } else {
            echo "Page Not Found !";
        }
    } // End // 

    // Update Coupon Section //
    public function coupon_update(Request $request)
    {
        $req = $request->id;

        if ($req !== Null) {
            Coupon::findOrFail($req)->update([
                'coupon_code' => $request->coupon_code,
                'valid_date' => $request->valid_date,
                'coupon_amount' => $request->coupon_amount,
                'status' => $request->status,
                'type' => $request->type,
                'created_at' => Carbon::now(),
            ]);
            $notification = array('messege' => 'Coupon Create Successfully', 'alert-type' => 'success');
            return redirect()->route('coupon.all_coupon')->with($notification);
        } else {
            echo "Page Not Found !";
        }
    } // End //

    // Delete Coupon Section
    public function coupon_delete(Request $request)
    {
        $req = $request->id;

        if ($req !== Null) {
            // DB::table('coupons')->where('id', $id)->delete();
            Coupon::findOrFail($req)->delete();

            $notification = array('messege' => 'Coupon Delete Successfully', 'alert-type' => 'success');
            return redirect()->route('coupon.all_coupon')->with($notification);
        } else {
            echo "page Not Found !";
        }
    } // End //
}
