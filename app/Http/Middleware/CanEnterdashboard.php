<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CanEnterdashboard
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
      $rolename = Auth::user()->role->name;
      if ($rolename == 'admin' or $rolename == 'superadmin') {
        return $next($request);
      }
        return redirect( url('/') );
    }
}