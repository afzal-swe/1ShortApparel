<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class UserProfileController extends Controller
{
    //

    private $db_tableuser;
    private $db_web_site_review;
    private $db_order;
    private $db_order_details;
    private $db_replies;





    /**
     * Create a new instance of the controller.
     *
     * This constructor applies the 'auth' middleware to ensure that the user is authenticated. It also initializes
     * database table names for various models used within the controller.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->db_web_site_review = "wereviews";
        $this->db_tableuser = "users";
        $this->db_order = "orders";
        $this->db_order_details = "order__details";
        $this->db_replies = "replies";
    }





    /**
     * Display the dashboard with user orders and order statistics.
     *
     * This method retrieves the latest 10 orders for the authenticated user, and calculates the total number of orders,
     * completed orders, canceled orders, and return orders. It then returns a view with these data points.
     *
     * @return \Illuminate\View\View
     */
    public function deshboard()
    {
        $orders = DB::table($this->db_order)
            ->where('user_id', Auth::id())
            ->orderBy('id', 'DESC')
            ->take(10)
            ->get();

        $total_order = DB::table('orders')
            ->where('user_id', Auth::id())
            ->count();

        $complete_order = DB::table('orders')
            ->where('user_id', Auth::id())
            ->where('status', 3)
            ->count();

        $cancel_order = DB::table('orders')
            ->where('user_id', Auth::id())
            ->where('status', 5)
            ->count();

        $return_order = DB::table('orders')
            ->where('user_id', Auth::id())
            ->where('status', 4)
            ->count();

        return view('home', compact('orders', 'total_order', 'complete_order', 'cancel_order', 'return_order'));
    }





    /**
     * Display the user profile view.
     *
     * This method returns the view for the user profile page.
     *
     * @return \Illuminate\View\View
     */
    public function user_info()
    {
        return view('user.profile');
    }





    /**
     * Update the user information.
     *
     * This method validates the provided 'name' to ensure it is unique and required, and then updates the 'name'
     * and 'phone' fields of the user in the 'users' table. It sets the 'updated_at' timestamp to the current time.
     * After the update, it redirects back with a success notification.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function userInfo_Update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|unique:users|max:50',
        ]);

        User::findOrFail($request->id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array('messege' => 'Save Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }





    /**
     * Display the user review writing page.
     *
     * This method returns the view for the page where users can write their reviews.
     *
     * @return \Illuminate\View\View
     */
    public function write_userReview()
    {
        return view('user.review_write');
    }





    /**
     * Store a website review from the authenticated user.
     *
     * This method first checks if the authenticated user has already submitted a review. If a review exists,
     * it redirects back with an error notification. If not, it inserts a new review record into the database
     * with the provided data and a timestamp. After storing the review, it redirects back with a success notification.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store_websiteReview(Request $request)
    {
        $check = DB::table($this->db_web_site_review)->where('user_id', Auth::id())->first();
        if ($check) {
            $notification = array('messege' => 'Review already exist !', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }

        $data = array();
        $data['user_id'] = Auth::id();
        $data['name'] = $request->name;
        $data['review'] = $request->review;
        $data['rating'] = $request->rating;
        $data['review_date'] = date('d , F Y');
        $data['status'] = 0;
        $data['created_at'] = Carbon::now();
        DB::table($this->db_web_site_review)->insert($data);
        $notification = array('messege' => 'Thank for your review !', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }





    /**
     * Display the user settings page.
     *
     * This method returns the view for the user settings page.
     *
     * @return \Illuminate\View\View
     */
    public function User_Setting()
    {

        return view('user.setting');
    }






    /**
     * Change the password for the authenticated user.
     *
     * This method validates the provided old password and new password fields. It checks if the old password matches
     * the current password for the user. If the passwords match, it updates the user's password to the new one, logs
     * out the user, and redirects to the home page with a success notification. If the old password does not match,
     * it redirects back with an error notification.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function customer_PasswordChange(Request $request)
    {

        // dd($request->all());
        $validated = $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $current_password = Auth::user()->password;  //login user password get


        $oldpass = $request->old_password;  //oldpassword get from input field
        $new_password = $request->password;  // newpassword get for new password
        if (Hash::check($oldpass, $current_password)) {  //checking oldpassword and currentuser password same or not
            $user = User::findorfail(Auth::id());    //current user data get
            $user->password = Hash::make($request->password); //current user password hasing
            $user->save();  //finally save the password
            Auth::logout();  //logout the admin user anmd redirect admin login panel not user login panel
            $notification = array('messege' => 'Your Password Changed!', 'alert-type' => 'success');
            return redirect()->to('/')->with($notification);
        } else {
            $notification = array('messege' => 'Old Password Not Matched!', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }





    /**
     * Display the user's tickets.
     *
     * This method retrieves the latest 10 tickets for the authenticated user from the 'tickets' table and returns
     * the view for the user's ticket page with these tickets.
     *
     * @return \Illuminate\View\View
     */
    public function Ticket()
    {
        $ticket = DB::table('tickets')->where('user_id', Auth::id())->orderBy('id', 'DESC')->take(10)->get();
        return view('user.ticket', compact('ticket'));
    }




    /**
     * Display the new ticket creation page.
     *
     * This method returns the view for the page where users can create a new ticket.
     *
     * @return \Illuminate\View\View
     */
    public function new_ticket()
    {
        return view('user.new_ticket');
    }






    /**
     * Store a new ticket.
     *
     * This method validates the provided 'subject' field. It then prepares ticket data, including optional image processing,
     * and inserts the ticket into the 'tickets' table. After storing the ticket, it redirects to the 'open.ticket' route
     * with a success notification.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store_ticket(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required',
        ]);

        $data = array();
        $data['subject'] = $request->subject;
        $data['service'] = $request->service;
        $data['priority'] = $request->priority;
        $data['message'] = $request->message;
        $data['user_id'] = Auth::id();
        $data['status'] = 0;
        $data['date'] = date('Y-m-d');

        if ($request->image) {
            //working with image
            $photo = $request->image;
            $photoname = uniqid() . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(600, 350)->save('image/ticket/' . $photoname);  //image intervention
            $data['image'] = 'image/ticket/' . $photoname;   // public/files/brand/plus-point.jpg
        }

        DB::table('tickets')->insert($data);
        $notification = array('messege' => 'Ticket Inserted!', 'alert-type' => 'success');
        return redirect()->route('open.ticket')->with($notification);
    }





    /**
     * Display a specific ticket.
     *
     * This method retrieves a ticket by its ID from the 'tickets' table and returns the view for displaying the ticket
     * details.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function show_Ticket(Request $request)
    {

        $ticket = DB::table('tickets')->where('id', $request->id)->first();
        return view('user.show_ticket', compact('ticket'));
    }






    /**
     * Reply to a ticket.
     *
     * This method validates the provided 'message' field and processes optional image uploads. It inserts a new reply
     * into the 'replies' table, updates the status of the associated ticket to 0, and then redirects back with a
     * success notification.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reply_Ticket(Request $request)
    {
        // dd($request->all());

        $validate = $request->validate([
            'message' => ['required'],
        ]);

        $data = array();
        $data['message'] = $request->message;
        $data['ticket_id'] = $request->ticket_id;
        $data['user_id'] = Auth::id();
        $data['reply_date'] = date('Y-m-d');


        if ($request->image) {
            $photo = $request->image;
            $photoname = uniqid() . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(600, 350)->save('image/ticket/' . $photoname);

            $data['image'] = "image/ticket/" . $photoname;
        }

        DB::table($this->db_replies)->insert($data);
        DB::table('tickets')->where('id', $request->ticket_id)->update(['status' => 0]);

        $notification = array('messege' => 'Replied Done', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
