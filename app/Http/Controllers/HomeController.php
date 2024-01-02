<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //

    // admin login From
    public function login_from()
    {
        return view('auth.admin_login');
    } //end

    public function customer_logout()
    {

        Auth::logout();
        return redirect()->to('/');
    }
}
