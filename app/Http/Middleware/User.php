<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class User
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        
        /* if(Auth()->user()->document != $request->input('document')){
            return redirect('/');
        } */

        /* return $next($request); */
    }
}