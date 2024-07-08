<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class BDPaymentController extends Controller
{
    //
    private $payment_gateway;

    public function __construct()
    {
        $this->payment_gateway = "payment_geteway_bd";
    }

    public function Payment_All()
    {
        $view_payment_gateway = DB::table($this->payment_gateway)->get();
        return view('admin.bd_payment_gateway.index', compact('view_payment_gateway'));
    }

    public function Payment_Gateway_Add(Request $request)
    {
        $request->validate([
            'gateway_name' => 'required',
        ]);

        $data = array();
        $data['gateway_name'] = $request->gateway_name;
        $data['store_id'] = $request->store_id ?? "Null";
        $data['signature_key'] = $request->signature_key ?? "Null";
        // $data['status'] = $request->status ;
        $data['created_at'] = Carbon::now();

        DB::table($this->payment_gateway)->insert($data);

        $notification = array('messege' => 'New Payment Option Added Successfully !!', 'alert-type' => "success");
        return redirect()->back()->with($notification);
    }

    public function Payment_Gateway_Edit()
    {

        $aamarpay = DB::table($this->payment_gateway)->first();
        $surjopay = DB::table($this->payment_gateway)->skip(1)->first();
        $ssl = DB::table($this->payment_gateway)->skip(2)->first();

        return view('admin.bd_payment_gateway.edit', compact('aamarpay', 'surjopay', 'ssl'));
    }

    public function Payment_Gateway_Delete(Request $request)
    {
        $req = $request->id;
        if ($req !== null) {
            DB::table($this->payment_gateway)->where('id', $req)->delete();

            $notification = array('messege' => 'Payment Gateway Delete Successfully !!', 'alert-type' => "success");
            return redirect()->back()->with($notification);
        } else {
            echo "Page Not Found !";
        }
    }
}
