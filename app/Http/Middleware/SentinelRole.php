<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class SentinelRole
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
      if (Sentinel::inRole('user') && Sentinel::getUser()->hasAccess([$request->route()->getName()])){
        return $next($request);
      }
      elseif (Sentinel::getUser()->hasAccess('admin')) {
        return $next($request);
      }
      else {
        abort(403);
      }
    }
}
