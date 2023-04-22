<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateLevels
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$levels)
    {
        if($request->user()->active != 1){
            return redirect('/')->withErrors(['Status tidak aktif silahkan hubungi customer services']);
        }elseif ( in_array($request->user()->level, $levels) ) {
            return $next($request);
        }
        abort(403);
        
        
    }
}
