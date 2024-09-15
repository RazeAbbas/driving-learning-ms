<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class AdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        /*if ($request->user()->role == '1' && $request->header('referer') == env('APP_URL')."/login") {
            Auth::logout();
            return redirect()->route('login'); 
        }*/
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if($request->user()->role != '1'){
            return redirect()->route('login');
        }
        return $next($request);
    }
}
