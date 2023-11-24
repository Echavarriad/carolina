<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth; 

class Xss
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
        //Si tiene pendiente el cambio de contraseña
        if(Auth::check()){
            if(Auth::user()->change_password && request()->route()->getName() != 'account.change_password' && request()->route()->getName() != 'account.home' && request()->route()->getName() != 'logout'){
                return redirect()->route('account.change_password');
            }
        }
        if (!in_array(strtolower($request->method()), ['put', 'post'])) {
            return $next($request);
        }
        
        $input = $request->all();

        array_walk_recursive($input, function(&$input) {
            $input = strip_tags($input);
        });

        $request->merge($input);       

        return $next($request);
    }
}
