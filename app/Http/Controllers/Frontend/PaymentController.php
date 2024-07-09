<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //

    public function success()
    {
    }
    public function fail(Request $request)
    {
        return $request;
    }
    // public function fail(Request $request)
    // {
    //     $notification = array('messege' => 'Fail !!', 'alert-type' => 'success');
    //     return redirect()->route('checkout')->with($notification);
    // }

    public function cancel()
    {
        $notification = array('messege' => 'Cancel Payment Option!!', 'alert-type' => 'success');
        return redirect()->route('checkout')->with($notification);
    }
}
