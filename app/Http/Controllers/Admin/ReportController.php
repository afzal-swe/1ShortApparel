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

    public function __construct()
    {
        $this->DB_Order = "orders";
    }


    // __ Order Report Function Section
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

    //__  Order Report Prent
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
}
