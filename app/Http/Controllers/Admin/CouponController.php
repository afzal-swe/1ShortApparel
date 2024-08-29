<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Coupon;

class CouponController extends Controller
{


    /**
     * Constructor for the controller.
     *
     * Applies the 'auth' middleware to ensure that only authenticated users
     * can access the controller's methods.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }





    /**
     * Retrieve and display all coupons.
     *
     * Fetches all coupon records from the database, ordered by the most recent first,
     * and passes them to the view for display.
     *
     * @return \Illuminate\View\View
     */
    public function all_coupon()
    {
        $data = Coupon::latest()->get();
        return view('admin.offer.coupon.index', compact('data'));
    }





    /**
     * Add a new coupon.
     *
     * Validates the incoming request data for `coupon_code` and `coupon_amount`,
     * then inserts a new coupon record into the database with the provided details.
     * Redirects back to the coupon list with a success notification.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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
    }




    /**
     * Show the form for editing a specific coupon.
     *
     * Retrieves the coupon record with the specified ID from the database
     * and passes it to the view for editing.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function coupon_edit(Request $request)
    {
        $req = $request->id;

        $edit = Coupon::findOrFail($req);
        return view('admin.offer.coupon.edit', compact('edit'));
    }





    /**
     * Update the specified coupon in the database.
     *
     * Updates the coupon record with the specified ID using the provided
     * data from the request. Sets the 'created_at' timestamp to the current time.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function coupon_update(Request $request)
    {
        $req = $request->id;

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
    }





    /**
     * Delete the specified coupon from the database.
     *
     * Finds the coupon record with the specified ID and deletes it from the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function coupon_delete(Request $request)
    {
        $req = $request->id;

        // DB::table('coupons')->where('id', $id)->delete();
        Coupon::findOrFail($req)->delete();

        $notification = array('messege' => 'Coupon Delete Successfully', 'alert-type' => 'success');
        return redirect()->route('coupon.all_coupon')->with($notification);
    }
}
