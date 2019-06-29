<?php

namespace App\Http\Middleware;


class SetLocale
{
    public function handle($request, \Closure $next)
    {
        app()->setLocale($request->segment(1));
        return $next($request);
    }
}
