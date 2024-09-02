<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class StripPaymentController extends Controller
{
    /**
     * Process a payment via Stripe and create an order with order details.
     *
     * @param \Illuminate\Http\Request $request
     * @param float $sub_total The subtotal for the order, initially passed as a parameter.
     * 
     * @return \Illuminate\Http\RedirectResponse Redirects to the homepage with a success notification.
     */
    public function stripePost(Request $request)
    {
        // Retrieve the current total from the shopping cart.
        $sub_total = Cart::total();

        // Set the Stripe API key from the environment configuration.
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        // Create a new Stripe charge with the given amount, currency, source, and description.
        Stripe\Charge::create([
            "amount" => $sub_total * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Thanks For Payment!"
        ]);

        // Initialize an order array and populate it with user, payment, and order details.
        $order = array();
        $order['user_id'] = Auth::id();
        $order['payment_type'] = '1';
        $order['tax'] = 0;
        $order['shipping_charge'] = 0;
        $order['order_id'] = rand(10000, 900000);
        $order['status'] = 0;
        $order['date'] = date('d-m-Y');
        $order['month'] = date('F');
        $order['year'] = date('Y');
        $order['total'] = Cart::total();

        // Check if a coupon is applied and adjust the order subtotal and discount details.
        if (Session::has('coupon')) {
            $order['subtotal'] = Cart::subtotal();
            $order['coupon_code'] = Session::get('coupon')['name'];
            $order['coupon_discount'] = Session::get('coupon')['discount'];
            $order['after_discount'] = Session::get('coupon')['after_discount'];
        } else {
            $order['subtotal'] = Cart::subtotal();
        }

        // Insert the order into the database and retrieve the order ID.
        $order_id = DB::table('orders')->insertGetId($order);

        // Retrieve the contents of the cart.
        $content = Cart::content();

        // Initialize an array to hold the order details and populate it with each item's details.
        $details = array();
        foreach ($content as $row) {
            $details['order_id'] = $order_id;
            $details['product_id'] = $row->id;
            $details['product_name'] = $row->name;
            $details['color'] = $row->options->color;
            $details['size'] = $row->options->size;
            $details['quantity'] = $row->qty;
            $details['single_price'] = $row->price;
            $details['subtotal_price'] = $row->price * $row->qty;

            // Insert the order details into the database.
            DB::table('order__details')->insert($details);
        }

        // Clear the cart and remove the coupon session if it exists.
        Cart::destroy();
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        // Create a success notification and redirect the user to the homepage.
        $notification = array('messege' => 'Successfully Order Placed!', 'alert-type' => 'success');
        return redirect()->to('/')->with($notification);
    }
}
