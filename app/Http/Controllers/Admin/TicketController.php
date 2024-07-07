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

    public function __construct()
    {

        $this->db_ticket = "tickets";
        $this->db_replies = "replies";
    }

    public function all_ticket(Request $request)
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

    // ticket Show

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

    public function close_ticket(Request $request)
    {
        DB::table('tickets')->where('id', $request->id)->update(['status' => 2]);

        $notification = array('messege' => 'Close Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function admin_ticket_delete(Request $request)
    {

        DB::table('tickets')->where('id', $request->id)->delete();

        $notification = array('messege' => 'Delete Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
