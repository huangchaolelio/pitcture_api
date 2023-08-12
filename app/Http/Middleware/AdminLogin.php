<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminLogin
{
    public function handle(Request $request, Closure $next)
    {
    	$username = Session::get('username');

    	if(empty($username)) {
    		return redirect('admin/login');
    	}

        return $next($request);
    }
}
