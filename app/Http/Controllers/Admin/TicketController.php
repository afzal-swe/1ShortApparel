<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class TicketController extends Controller
{
    //

    private $db_ticket;
    private $db_replies;




    /**
     * Create a new instance of the controller.
     *
     * This constructor initializes database table names for the `tickets` and `replies` tables.
     * The table names are stored in properties for use in other methods of the controller.
     */
    public function __construct()
    {

        $this->db_ticket = "tickets";
        $this->db_replies = "replies";
    }




    /**
     * Display a listing of the tickets with optional filtering and data table formatting.
     *
     * This method handles an AJAX request to fetch and filter ticket data based on date, type, and status.
     * It joins the `tickets` table with the `users` table to get the user names associated with the tickets.
     * It uses DataTables for formatted output and adds action buttons for viewing and deleting tickets.
     *
     * @param  \Illuminate\Http\Request  $request  The request object containing filters and AJAX request information.
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View Returns a JSON response with formatted ticket data if AJAX request, otherwise a view.
     */
    public function all_ticket(Request $request)
    {
        if ($request->ajax()) {

            $ticket = "";
            $query = DB::table('tickets')->orderBy('id', 'DESC')->leftJoin('users', 'tickets.user_id', 'users.id');

            if ($request->date) {
                $query->where('tickets.date', $request->date);
            }

            if ($request->type == 'Technical') {
                $query->where('tickets.service', $request->type);
            }
            if ($request->type == 'Payment') {
                $query->where('tickets.service', $request->type);
            }
            if ($request->type == 'Affiliate') {
                $query->where('tickets.service', $request->type);
            }
            if ($request->type == 'Return') {
                $query->where('tickets.service', $request->type);
            }
            if ($request->type == 'Refund') {
                $query->where('tickets.service', $request->type);
            }

            if ($request->status == 1) {
                $query->where('tickets.status', 1);
            }

            if ($request->status == 0) {
                $query->where('tickets.status', 0);
            }

            if ($request->status == 2) {
                $query->where('tickets.status', 2);
            }

            $ticket = $query->select('tickets.*', 'users.name')->get();
            return DataTables::of($ticket)

                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return '<span class="badge badge-warning"> Running </span>';
                    } elseif ($row->status == 2) {
                        return '<span class="badge badge-muted"> Close </span>';
                    } else {
                        return '<span class="badge badge-danger"> Pending </span>';
                    }
                })
                ->editColumn('date', function ($row) {
                    return date('d F Y', strtotime($row->date));
                })
                ->addColumn('action', function ($row) {
                    $actionbtn = '
                        <a href="' . route('admin.ticket.show', [$row->id]) . '" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                        <a href="' . route('admin.ticket.delete', [$row->id]) . '" class="btn btn-danger btn-sm" id="delete_ticket"><i class="fas fa-trash"></i>
                        </a>';
                    return $actionbtn;
                })
                ->rawColumns(['action', 'status', 'date'])
                ->make(true);
        }
        return view('admin.ticket.index');
    }






    /**
     * Display the details of a specific ticket.
     *
     * This method retrieves a specific ticket's details by its ID from the `tickets` table and
     * joins it with the `users` table to get the user's name associated with the ticket.
     * It then returns a view with the ticket details.
     *
     * @param  \Illuminate\Http\Request  $request  The request object containing the ticket ID.
     * @return \Illuminate\View\View Returns a view displaying the details of the specified ticket.
     */
    public function admin_ticket_show(Request $request)
    {
        $ticket = DB::table('tickets')
            ->leftJoin('users', 'tickets.user_id', 'users.id')
            ->select('tickets.*', 'users.name')
            ->where('tickets.id', $request->id)
            ->first();
        // dd($ticket);
        return view('admin.ticket.view_ticket', compact('ticket'));
    }





    /**
     * Store a reply to a ticket and update its status.
     *
     * This method handles storing a reply message for a specific ticket, including optional image
     * attachment. It validates the request, processes the image if provided, and updates the
     * status of the ticket to indicate that it has been replied to.
     *
     * @param  \Illuminate\Http\Request  $request  The request object containing the reply message, ticket ID, and optional image.
     * @return \Illuminate\Http\RedirectResponse Redirects back with a success message.
     */
    public function admin_store_reply(Request $request)
    {
        $validate = $request->validate([
            'message' => ['required'],
        ]);

        $data = array();
        $data['message'] = $request->message;
        $data['ticket_id'] = $request->ticket_id;
        $data['user_id'] = 0;
        $data['reply_date'] = date('Y-m-d');

        if ($request->image) {
            $photo = $request->image;
            $photoname = uniqid() . '-' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(600, 350)->save('image/ticket/' . $photoname);

            $data['image'] = "image/ticket/" . $photoname;
        }

        DB::table($this->db_replies)->insert($data);
        DB::table('tickets')->where('id', $request->ticket_id)->update(['status' => 1]);

        $notification = array('messege' => 'Replied Done', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }






    /**
     * Close a ticket by updating its status to 'closed'.
     *
     * This method handles the closure of a specific ticket by updating its status in the database
     * to indicate that it has been closed.
     *
     * @param  \Illuminate\Http\Request  $request  The request object containing the ticket ID.
     * @return \Illuminate\Http\RedirectResponse Redirects back with a success message.
     */
    public function close_ticket(Request $request)
    {
        DB::table('tickets')->where('id', $request->id)->update(['status' => 2]);

        $notification = array('messege' => 'Close Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }


    /**
     * Delete a specific ticket from the database.
     *
     * This method deletes a ticket identified by its ID from the database. After successful deletion,
     * it redirects back to the previous page with a success notification.
     *
     * @param  \Illuminate\Http\Request  $request  The request object, containing the ID of the ticket to delete.
     * @param  int  $id  The ID of the ticket to be deleted.
     * @return \Illuminate\Http\RedirectResponse Redirects back with a success message.
     */
    public function admin_ticket_delete(Request $request, $id)
    {
        // dd($request->id);

        DB::table('tickets')->where('id', $id)->delete();

        $notification = array('messege' => 'Delete Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
