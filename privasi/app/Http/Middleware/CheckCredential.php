<?php

namespace App\Http\Middleware;

use Closure;

class CheckCredential
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
        if($request->header('token') == "" && $request->header('email')==""){
            return redirect('sqlserver');
        }
        return $next($request);
    }
}
