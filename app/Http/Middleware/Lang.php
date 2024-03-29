<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\App;

use Closure;
use Illuminate\Http\Request;

class Lang
{    
    public function handle(Request $request, Closure $next)
    {
       $lang = $request->session()->get('lang');
       // if (! $lang) {
       //   $lang = "en";
       // }
       $lang = $lang ?? "en";

       App::setLocale($lang);

        return $next($request);
    }
}
