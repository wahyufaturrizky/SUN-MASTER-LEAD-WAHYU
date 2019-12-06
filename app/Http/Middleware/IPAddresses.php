<?php

namespace App\Http\Middleware;

use Closure;

class IPAddresses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Only in Production Mode
        // if ($request->ip() != '172.19.0.1') {
        //     abort(403);
        // }
        return $next($request);
    }
}
