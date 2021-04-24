<?php

namespace App\Http\Middleware;

use Closure;
use App\User ;
class active
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next , $guard = null)
    {
        if(\Auth::guard($guard)->check()){

            $email  = \Auth::user()->email ;
            $m      =   User::where('email' , $email)->where('status' , 0)->first();

         if($m == null){
             \Auth::guard('web')->logout();
             session()->flash('error' , 'need to activated');
             return redirect('login');
         }
            return $next($request);
        }else{
            return redirect('login');
        }
       

      
        
      
    }
}
