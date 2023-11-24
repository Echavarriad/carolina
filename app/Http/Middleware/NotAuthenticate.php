<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class NotAuthenticate

{

    /**

     * @param $request
     * @param Closure $next
     * @param null $guard
     * @return \Illuminate\Http\RedirectResponse
     */

    public function handle($request, Closure $next, $guard = null)

    {

        if (Auth::check()) {
            return redirect()->route('home');
        }
        return $next($request);

    }

}

