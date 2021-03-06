<?php

namespace App\Http\Middleware;

use Closure;

class isSmeService
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
        if ((session()->has('default_service')) && (session('default_service')=='sme')){
            return $next($request);
        }
        else{
            return redirect()->action('AuthController@selectDefaultService');
        }
    }
}
