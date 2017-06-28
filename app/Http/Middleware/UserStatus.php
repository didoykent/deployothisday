<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class UserStatus
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
      if(Auth::user()->status == 'banned'){

        Auth::logout();
      return redirect()->route('user.signin')->with('error', 'Your account has been Suspended');


      }
        return $next($request);
    }



}
