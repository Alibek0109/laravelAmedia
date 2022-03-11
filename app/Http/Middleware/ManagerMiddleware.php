<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->role !== 'manager') {
            return redirect()->route('home.user.index');
        }
        return $next($request);
    }
}
