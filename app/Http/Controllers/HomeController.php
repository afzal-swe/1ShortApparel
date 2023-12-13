<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    // admin login From
    public function login_from()
    {
        return view('auth.admin_login');
    } //end
}
