<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SupperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth()->user()->supper_admin == 1) {
            return $next($request);
        } else {
            $notification = array('messege' => 'Successfully !', 'alert-type' => 'success');
            return redirect()->route('home_page')->with($notification);
        }
    }
}
