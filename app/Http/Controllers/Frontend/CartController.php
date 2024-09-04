<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
// use Cart;

class CartController extends Controller
{





    /**
     * Constructor to initialize middleware.
     *
     * Applies the 'auth' middleware to ensure that the user is authenticated for all routes in this controller.
     */
    public function __construct()
    {
        // Apply 'auth' middleware
        $this->middleware('auth');
    }










    /**
     * Adds a product to the shopping cart.
     *
     * Retrieves the product by its ID, then adds it to the cart with the specified quantity, price, and other options such as size, color, and thumbnail.
     * A success notification is displayed after the product is added to the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToCart(Request $request)
    {

        // Retrieve the product by its ID
        $product = Product::where('id', $request->id)->first();
        // dd($product);
        // $user_id = Auth::user()->id;

        // Add the product to the cart with the specified details
        $data = Cart::add([
            'id' => $product->id,
            'name' => $product->product_title,
            'price' => $request->price,
            'qty' => $request->quantity_input,
            'weight' => '1',
            'options' => [
                'size' => $request->size,
                'color' => $request->color,
                'thumbnail' => $product->thumbnail
            ]
        ]);

        // Display a success notification and redirect back
        $notification = array('messege' => 'Add To Cart Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }










    /**
     * Displays the contents of the user's shopping cart.
     *
     * Retrieves the current cart contents and passes them to the cart view for display.
     *
     * @return \Illuminate\View\View
     */
    public function my_cart()
    {

        // Retrieve the current cart contents
        $content = Cart::content();

        // Return the cart view with the cart contents
        return view('frontend.cart.cart', compact('content'));
    }












    /**
     * Removes a specific product from the shopping cart.
     *
     * Removes the product identified by the given row ID from the cart and redirects back with a success notification.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cart_product_remove(Request $request)
    {

        // Remove the product from the cart using the provided row ID
        Cart::remove($request->rowId);

        // Set a success notification message
        $notification = array('messege' => 'Cart Remove Successfully', 'alert-type' => 'success');

        // Redirect back with the notification message
        return redirect()->back()->with($notification);
    }










    /**
     * Clears all items from the shopping cart.
     *
     * Destroys the entire cart, removing all items, and redirects back with a success notification.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cart_destory()
    {
        // Destroy the cart, removing all items
        Cart::destroy();

        // Set a success notification message
        $notification = array('messege' => 'Cart item Clear!', 'alert-type' => 'success');

        // Redirect back with the notification message
        return redirect()->back()->with($notification);
    }









    /**
     * Displays the checkout page.
     *
     * Redirects the user to the login page if they are not authenticated.
     * Otherwise, retrieves the cart contents and returns the checkout view.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function checkout()
    {
        if (!Auth::check()) {
            $notification = array('messege' => 'Login Your Account', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }

        // Get the contents of the cart
        $content = Cart::content();
        return view('frontend.cart.checkout', compact('content'));
    }












    /**
     * Applies a coupon to the cart.
     *
     * Validates the coupon code and, if valid and not expired, applies the discount to the cart. 
     * If the coupon is invalid or expired, sets an error notification.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function applyCoupon(Request $request)
    {

        // Retrieve the coupon code from the request
        $coupon = $request->coupon;


        // Check if the coupon code exists in the database
        $check = DB::table('coupons')->where('coupon_code', $coupon)->first();
        // dd($check);

        if ($check) {

            // Verify if the coupon is still valid
            if (date('Y-m-d', strtotime(date('Y-m-d'))) <= date('Y-m-d', strtotime($check->valid_date))) {

                // Apply the coupon discount to the session
                $test = session::put('coupon', [
                    'name' => $check->coupon_code,
                    'discount' => $check->coupon_amount,
                    'after_discount' => Cart::subtotal() - $check->coupon_amount,

                ]);

                // Set a success notification
                $notification = array('messege' => 'Coupon Applied!', 'alert-type' => 'success');
                return redirect()->back()->with($notification);
            } else {

                // Set an error notification for expired coupon
                $notification = array('messege' => 'Expired Coupon Code!', 'alert-type' => 'error');
                return redirect()->back()->with($notification);
            }
        } else {

            // Set an error notification for invalid coupon
            $notification = array('messege' => 'Invalid Coupon Code! Try Again.', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }









    /**
     * Removes the coupon from the session.
     *
     * Clears the coupon data from the session and redirects back with a success message.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function couponRemove()
    {

        // Remove the coupon data from the session
        Session::forget('coupon');

        // Set a notification message indicating that the coupon was removed
        $notification = array('messege' => 'Coupon Removed!', 'alert-type' => 'success');


        // Redirect back with the notification message
        return redirect()->back()->with($notification);
    }
}
