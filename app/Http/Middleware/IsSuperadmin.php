<?php

namespace App\Http\Middleware;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class IsSuperadmin
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
      if (Auth::user()->role->name == 'superadmin' ) {
        return redirect( url('/') );
      }
        return $next($request);
    }
}
