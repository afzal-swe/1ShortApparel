<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\Models\Campaingn;

class CampaignController extends Controller
{
    //
    private $db_tableName;

    public function __construct()
    {
        $this->middleware('auth');
        $this->db_tableName = "campaingns";
    }

    public function all_campaign()
    {

        $data = DB::table($this->db_tableName)->orderBy('id', 'DESC')->get();

        return view('admin.offer.campaign.index', compact('data'));
    }



    public function campaign_add(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:campaingns|max:50',
            'image' => 'required',
        ]);

        if ($request->file('image')) {

            $name = Str::of($request->title)->slug('-');

            $img = $request->file('image');
            $name_gen = $name . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(468, 90)->save("image/campaign/" . $name_gen);
            $save_img = "image/campaign/" . $name_gen;

            Campaingn::insert([
                'title' => $request->title ?? "Null",
                'start_date' => $request->start_date ?? "Null",
                'end_date' => $request->end_date ?? "Null",
                'discount' => $request->discount ?? "Null",
                'slug' => $name ?? "Null",
                'image' => $save_img ?? "Null",
                'month' => date('F'),
                'year' => date('Y'),
                'status' => $request->status ?? "Null",
                'created_at' => Carbon::now(),

            ]);
            $notification = array('messege' => 'Campaign Create Successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    }



    // Edit Campaign Function
    public function campaign_edit($id)
    {
        $data = Campaingn::find($id);
        return view('admin.offer.campaign.edit', compact('data'));
    }


    public function campaign_update(Request $request)
    {
        $update = $request->id;
        $file = Campaingn::findOrFail($update);

        if ($request->file('image')) {

            $img = $file->image;
            unlink($img);

            $name = Str::of($request->title)->slug('-');

            $img = $request->file('image');

            $name_gen = $name . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(468, 90)->save("image/campaign/" . $name_gen);
            $save_img = "image/campaign/" . $name_gen;

            Campaingn::findOrFail($update)->update([
                'title' => $request->title ?? "Null",
                'start_date' => $request->start_date ?? "Null",
                'end_date' => $request->end_date ?? "Null",
                'discount' => $request->discount ?? "Null",
                'slug' => $name ?? "Null",
                'image' => $save_img ?? "Null",
                'month' => date('F'),
                'year' => date('Y'),
                'status' => $request->status ?? "Null",
                'image' => $save_img,
                'updated_at' => Carbon::now(),

            ]);
            $notification = array('messege' => 'Campaingn Update Successfully', 'alert-type' => 'success');
            return redirect()->route('campaign.all_campaign')->with($notification);
        } else {
            Campaingn::findOrFail($update)->update([
                'title' => $request->title ?? "Null",
                'start_date' => $request->start_date ?? "Null",
                'end_date' => $request->end_date ?? "Null",
                'discount' => $request->discount ?? "Null",
                'slug' => $name ?? "Null",
                'image' => $save_img ?? "Null",
                'month' => date('F'),
                'year' => date('Y'),
                'status' => $request->status ?? "Null",
                'updated_at' => Carbon::now(),
            ]);
            $notification = array('messege' => 'Brand Update Successfully', 'alert-type' => 'success');
            return redirect()->route('campaign.all_campaign')->with($notification);
        }
    }

    public function campaign_delete($id)
    {
        $campaign = Campaingn::findOrFail($id);

        if ($campaign->image) {
            // Get the image path
            $img = $campaign->image;

            // Check if the file exists before attempting to delete it
            if (file_exists($img)) {
                unlink($img); // Delete the image file
            }
        }

        // Delete the campaign record from the database
        $campaign->delete();

        // Set notification message
        $notification = array('message' => 'Campaign deleted successfully', 'alert-type' => 'success');

        // Redirect back with notification
        return redirect()->back()->with($notification);
    }
}
