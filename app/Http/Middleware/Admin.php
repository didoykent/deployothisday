<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class Admin
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
      if(Auth::user()->thisUserRole == 'positionrivadmin') // is an admin
        {
            return $next($request); // pass the admin
        }

        return redirect('/'); // not admin. redirect whereever you like

    }
    }
