<?php

namespace App\Http\Middleware;

use Closure;

class lang
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
         if(session()->has('lang') == null){
            \App::setLocale('ar') ;
            session()->put('lang' , 'ar');
        }else{
            $i = session()->get('lang') ;
             \App::setLocale($i) ;
        }
        return $next($request);
    }
}
