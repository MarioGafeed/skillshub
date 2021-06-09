<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CanEnterExam
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
      // ده البارميتر اللي جاي من الــ الروت
        $examId = $request->route()->parameters('id');
        $user = Auth::User();
        $pivotRow = $user->exams()->where('$examId', $examId)->first();
        if ($pivotRow == null and $pivotRow->pivot->status == 'closed' ) {
          return redirect( url('/') );
        }
        return $next($request);
    }
}
