<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class ReportController extends Controller
{
    //
    private $DB_Order;
    private $db_replies;



    /**
     * Initialize a new instance of the controller.
     *
     * This constructor method sets up the database table names used in the controller. It assigns the table
     * names for orders and replies to the respective properties of the controller.
     *
     * @return void
     */
    public function __construct()
    {
        $this->DB_Order = "orders";
        $this->db_replies = "replies";
    }




    /**
     * Generate a report of orders with optional filtering.
     *
     * This method handles AJAX requests to filter and retrieve orders based on various criteria such as
     * payment type, date, and status. It formats the status column for display and returns the data
     * in a format suitable for DataTables.
     *
     * @param \Illuminate\Http\Request $request The request instance containing filtering parameters.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *         If the request is an AJAX request, returns the filtered orders data in JSON format suitable for DataTables.
     *         Otherwise, returns the view for the order report page.
     */
    public function Order_report(Request $request)
    {

        if ($request->ajax()) {
            $imgurl = 'public/files/product';

            $product = "";
            $query = DB::table($this->DB_Order)->orderBy('id', 'DESC');

            if ($request->payment_type) {
                $query->where('payment_type', $request->payment_type);
            }

            if ($request->date) {
                $order_date = date('m-d-Y', strtotime($request->date));
                $query->where('date', $order_date);
            }

            if ($request->status == 0) {
                $query->where('status', 0);
            }
            if ($request->status == 1) {
                $query->where('status', 1);
            }
            if ($request->status == 2) {
                $query->where('status', 2);
            }
            if ($request->status == 3) {
                $query->where('status', 3);
            }
            if ($request->status == 4) {
                $query->where('status', 4);
            }
            if ($request->status == 5) {
                $query->where('status', 5);
            }


            $product = $query->get();
            return DataTables::of($product)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    if ($row->status == 0) {
                        return '<span class="badge badge-danger">Pending</span>';
                    } elseif ($row->status == 1) {
                        return '<span class="badge badge-primary">Recieved</span>';
                    } elseif ($row->status == 2) {
                        return '<span class="badge badge-info">Shipped</span>';
                    } elseif ($row->status == 3) {
                        return '<span class="badge badge-success">Completed</span>';
                    } elseif ($row->status == 4) {
                        return '<span class="badge badge-warning">Return</span>';
                    } elseif ($row->status == 5) {
                        return '<span class="badge badge-danger">Cancel</span>';
                    }
                })
                ->rawColumns(['status'])
                ->make(true);
        }
        return view('admin.report.order.order_report');
    }





    /**
     * Generate a printable report of orders with optional filtering.
     *
     * This method handles AJAX requests to filter and retrieve orders based on various criteria such as
     * payment type, date, and status. It returns a view with the filtered orders data for printing purposes.
     *
     * @param \Illuminate\Http\Request $request The request instance containing filtering parameters.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *         If the request is an AJAX request, returns the filtered orders data in a format suitable for printing.
     *         Otherwise, returns the view for printing the order report.
     */
    public function Print_report(Request $request)
    {
        if ($request->ajax()) {
            $order = "";
            $query = DB::table($this->DB_Order)->orderBy('id', 'DESC');
            if ($request->payment_type) {
                $query->where('payment_type', $request->payment_type);
            }

            if ($request->date) {
                $order_date = date('d-m-Y', strtotime($request->date));
                $query->where('date', $order_date);
            }

            if ($request->status == 0) {
                $query->where('status', 0);
            }
            if ($request->status == 1) {
                $query->where('status', 1);
            }
            if ($request->status == 2) {
                $query->where('status', 2);
            }
            if ($request->status == 3) {
                $query->where('status', 3);
            }
            if ($request->status == 4) {
                $query->where('status', 4);
            }
            if ($request->status == 5) {
                $query->where('status', 5);
            }
            $order = $query->get();
        }

        return view('admin.report.order.print', compact('order'));
    }





    /**
     * Retrieve and display a list of tickets with optional filtering.
     *
     * This method handles AJAX requests to filter and retrieve tickets based on various criteria such as
     * date, service type, and status. It returns a DataTables response for dynamic table updates.
     *
     * @param \Illuminate\Http\Request $request The request instance containing filtering parameters.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *         If the request is an AJAX request, returns a DataTables response with the filtered ticket data.
     *         Otherwise, returns the view for displaying the ticket report.
     */
    public function Ticket_View(Request $request)
    {
        if ($request->ajax()) {

            $ticket = "";
            $query = DB::table('tickets')->leftJoin('users', 'tickets.user_id', 'users.id');

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


                ->rawColumns(['status', 'date'])
                ->make(true);
        }
        return view('admin.report.ticket.ticket_view');
    }



    /**
     * Retrieve and display a printable list of tickets with optional filtering.
     *
     * This method handles AJAX requests to filter and retrieve tickets based on various criteria such as
     * date, service type, and status. It returns a DataTables response for dynamic updates if requested via AJAX.
     * If not an AJAX request, it returns the view for printing the ticket report with the filtered data.
     *
     * @param \Illuminate\Http\Request $request The request instance containing filtering parameters.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *         If the request is an AJAX request, returns a DataTables response with the filtered ticket data.
     *         Otherwise, returns the view for printing the ticket report.
     */
    public function Ticket_Print(Request $request)
    {
        if ($request->ajax()) {

            $ticket = "";
            $query = DB::table('tickets')->leftJoin('users', 'tickets.user_id', 'users.id');

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
                });
        }

        return view('admin.report.ticket.ticket_print', compact('ticket'));
    }
}
