<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class F_PageController extends Controller
{


    /**
     * Display a specific page based on the provided slug.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function view_Page(Request $request)
    {

        $page = DB::table('pages')->where('page_slug', $request->page_slug)->first();

        return view('frontend.page.page', compact('page'));
    }
}
