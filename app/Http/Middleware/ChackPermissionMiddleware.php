<?php

namespace App\Http\Middleware;

use Closure;

class ChackPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next , $permission)
    {
        $permissions = explode('|', $permission);
        foreach ($permissions as $permission){
            if ($request->user()->hasPermissionTo($permission)){
                return $next($request);
            }
        }
        abort('401');


    }
}
