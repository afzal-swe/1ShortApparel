<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{




    /**
     * Display the blog page.
     *
     * @return \Illuminate\View\View
     */
    public function Blog()
    {
        // Return the 'blog' view located in the 'frontend.blog' directory.
        return view('frontend.blog.blog');
    }
}
