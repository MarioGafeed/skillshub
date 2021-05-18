<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
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
      $adminrole  == Role::where('name', 'admin')->first();
      if (Auth::user()->role_id !== $adminrole->id ) {
        return redirect( url('/') );
      }
        return $next($request);
    }
}
