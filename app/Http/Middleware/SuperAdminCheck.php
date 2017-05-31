<?php

namespace App\Http\Middleware;

use Closure;

class SuperAdminCheck
{
    /**
     * Checking the role of a user or admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (in_array('super-admin', auth()->user()->role->pluck('id')->toArray())) {
            return $next($request);
        } else {
            abort(403, 'Access denied');
        }
        return $next($request);
    }
}
