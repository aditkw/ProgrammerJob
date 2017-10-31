<?php

namespace App\Http\Middleware;

use Closure;
Use Sentinel;

class SentinelMiddleware
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
      if (Sentinel::guest()) {
         if ($request->ajax())
         return response('Unauthorized.', 401);

         else
         return redirect()->guest('login')->with('warning', 'Ups! kamu harus login untuk masuk halaman tersebut');
         }

         return $next($request);
    }
}
