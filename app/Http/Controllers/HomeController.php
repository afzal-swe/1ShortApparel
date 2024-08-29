<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * Display the admin login form.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function login_from()
    {
        // Returns the 'auth.admin_login' view for the admin login form
        return view('auth.admin_login');
    }




    /**
     * Log out the authenticated user and redirect to the home page.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function customer_logout()
    {
        // Logs out the currently authenticated user
        Auth::logout();

        // Redirects to the home page
        return redirect()->to('/');
    }
}
