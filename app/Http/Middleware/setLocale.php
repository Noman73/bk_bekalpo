<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class setLocale
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
        if($request->route('locale')==null){
            app()->setLocale('en');
        }else{
            app()->setLocale($request->route('locale'));
        }
        info($request->route('locale'));
        return $next($request);
    }
}
