<?php

namespace App\Http\Middleware;

use Closure;

class CacheMiddleware
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
         app(\Barryvdh\HttpCache\Middleware\CacheRequests::class)->handle($request, function ($request) use ($next)
        {
            return $next($request);
        });

        return $next($request);
    }
}
