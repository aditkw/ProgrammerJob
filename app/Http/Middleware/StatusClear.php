<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;

class StatusClear
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
      $user = $request->user();
      $id = $user->id;
      $user = User::where('id', $id)->first();
        if($user->status == 1){
          return redirect()->route('profile.edit')
          ->with('notice', 'Lengkapi profil terlebih dahulu untuk dapat mengakses halaman tersebut..');
        }
      return $next($request);
    }
}
