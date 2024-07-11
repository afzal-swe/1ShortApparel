<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //
    // Blog Function
    public function Blog()
    {
        return view('frontend.blog.blog');
    }
}
