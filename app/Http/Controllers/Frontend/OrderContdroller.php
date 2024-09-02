<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderContdroller extends Controller
{
    //

    private $db_order;
    private $db_order_details;
    private $payment_gateway;



    /**
     * Constructor for initializing middleware and setting database table names.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->db_order = "orders";
        $this->db_order_details = "order__details";
        $this->payment_gateway = "payment_geteway_bd";
    }




    /**
     * Retrieve the list of orders for the authenticated user.
     *
     * @return \Illuminate\View\View
     */
    public function Order_List()
    {
        $orders = DB::table($this->db_order)
            ->where('user_id', Auth::id())
            ->orderBy('id', 'DESC')
            ->take(10)
            ->get();

        return view('user.my_order', compact('orders'));
    }

    public function OrderPlace(Request $request)
    {

        $validate = $request->validate([


            'c_email' => 'required',
        ]);

        if ($request->payment_type == 2) {
            $order = array();
            $order['user_id'] = Auth::id();
            $order['c_name'] = $request->c_name;
            $order['c_phone'] = $request->c_phone;
            $order['c_country'] = $request->c_country;
            $order['c_address'] = $request->c_address;
            $order['c_email'] = $request->c_email;
            $order['c_zipcode'] = $request->c_zipcode;
            $order['c_city'] = $request->c_city;
            $order['c_extra_phone'] = $request->c_extra_phone ?? "Null";
            $order['payment_type'] = $request->payment_type;
            $order['tax'] = 0;
            $order['shipping_charge'] = 0;
            $order['order_id'] = rand(10000, 900000);
            $order['status'] = 0;
            $order['date'] = date('d-m-Y');
            $order['month'] = date('F');
            $order['year'] = date('Y');
            $order['total'] = Cart::total();

            if (Session::has('coupon')) {
                $order['subtotal'] = Cart::subtotal();
                $order['coupon_code'] = Session::get('coupon')['name'];
                $order['coupon_discount'] = Session::get('coupon')['discount'];
                $order['after_discount'] = Session::get('coupon')['after_discount'];
            } else {
                $order['subtotal'] = Cart::subtotal();
            }

            $order_id = DB::table('orders')->insertGetId($order);

            // $mail = Mail::to($request->c_email)->send(new InvoiceMail($order));
            // dd($mail);

            // Order Details
            $content = Cart::content();

            $mail = Mail::to($request->c_email)->send(new InvoiceMail($order, $content));

            $details = array();
            foreach ($content as $row) {
                // dd($row);

                $details['order_id'] = $order_id;
                $details['product_id'] = $row->id;
                $details['product_name'] = $row->name;
                $details['color'] = $row->options->color;
                $details['size'] = $row->options->size;
                $details['quantity'] = $row->qty;
                $details['single_price'] = $row->price;
                $details['subtotal_price'] = $row->price * $row->qty;

                DB::table('order__details')->insert($details);
            }


            Cart::destroy();
            if (Session::has('coupon')) {
                Session::forget('coupon');
            }

            $notification = array('messege' => 'Successfully Order Placed!', 'alert-type' => 'success');
            return redirect()->to('/')->with($notification);

            // __Aamar Pay Payment Gateway Option
        }

        // __ Paypal Gateway option
        elseif ($request->payment_type == 1) {
            return view('frontend.cart.pay_to_cart');
        } else {
            $notification = array('messege' => 'Successfully Order Placed!', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    }

    public function success(Request $request)
    {
        return Cart::content();
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






    /**
     * View the details of a specific order.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function Order_View(Request $request)
    {

        $order = DB::table($this->db_order)->where('id', $request->id)->first();
        // dd($order);
        $order_details = DB::table($this->db_order_details)->where('order_id', $request->id)->get();

        return view('user.order_details', compact('order', 'order_details'));
    }
}
