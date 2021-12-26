<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if(\Auth::check() == 0 || !\Auth::User()->isAdmin()) {
            return redirect()->back();
        }

        return $next($request);
    }
}
