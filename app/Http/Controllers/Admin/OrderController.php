<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    //
    private $DB_Order;

    public function __construct()
    {
        $this->DB_Order = "orders";
    }


    //__order list
    public function All_Order(Request $request)
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
                ->addColumn('action', function ($row) {
                    $actionbtn = '
                            <a href="#" data-id="' . $row->id . '" class="btn btn-primary btn-sm view" data-toggle="modal" data-target="#viewModal"><i class="fas fa-eye"></i></a>
                            <a href="#" data-id="' . $row->id . '" class="btn btn-info btn-sm edit" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a> 
                            <a href="' . route('order.delete', [$row->id]) . '" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i>
                            </a>';
                    return $actionbtn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('admin.order.view_order');
    }

    //__order edit
    public function Editorder(Request $request)
    {
        $order_edit = DB::table($this->DB_Order)->where('id', $request->id)->first();
        return view('admin.order.update_order', compact('order_edit'));
    }

    //__update status
    public function updateStatus(Request $request)
    {
        $data = array();
        $data['c_name'] = $request->c_name;
        $data['c_email'] = $request->c_email;
        $data['c_address'] = $request->c_address;
        $data['c_address'] = $request->c_address;
        $data['status'] = $request->status;

        // if($request->status=='1'){
        //     Mail::to($request->c_email)->send(new RecievedMail($data));
        // }

        DB::table($this->DB_Order)->where('id', $request->id)->update($data);
        return response()->json('successfully changed status!');
    }


    //__view Order
    public function ViewOrder(Request $request)
    {
        $order = DB::table($this->DB_Order)->where('id', $request->id)->first();
        $order_details = DB::table('order__details')->where('order_id', $request->id)->get();
        return view('admin.order.order_details', compact('order', 'order_details'));
    }

    //__delete
    public function delete($id)
    {
        $order = DB::table('orders')->where('id', $id)->delete();
        $order_details = DB::table('order__details')->where('order_id', $id)->delete();
        $notification = array('messege' => 'Order deleted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
