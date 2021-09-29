<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->user()->isSuperUser() || $request->user()->isStaffUser()|| $request->user()->isAdmin()|| $request->user()->isSuperAdmin()) {
            return $next($request);
        }
        return redirect('/');
    }
}
