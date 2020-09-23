<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string $role
     * @return mixed
     */

    public function handle($request, Closure $next, $role)
    {
        if(!$request->user()->hasRole($role)) {
            return redirect()->action('HomeController@index');
        }

        return $next($request);
    }
}
