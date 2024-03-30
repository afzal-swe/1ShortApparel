<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class F_PageController extends Controller
{
    //

    public function view_Page(Request $request)
    {

        $page = DB::table('pages')->where('page_slug', $request->page_slug)->first();

        return view('frontend.page.page', compact('page'));
    }
}
